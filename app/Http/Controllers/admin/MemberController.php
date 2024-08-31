<?php

namespace App\Http\Controllers\admin;

// Includes
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Carbon\Carbon;

// Requests
use App\Http\Requests\admin\members\StoreRequest;
use App\Http\Requests\admin\members\UpdateRequest;
use App\Http\Requests\admin\members\PfpRequest;
use App\Http\Requests\admin\members\DocumentsRequest;
use App\Http\Requests\admin\members\PlanRequest;
use App\Http\Requests\admin\members\WorkoutRequest;

// Models
use App\Models\User;
use App\Models\UserDocument;
use App\Models\Plan;
use App\Models\Pricing;
use App\Models\Workout;

// Mails
use App\Mail\admin\StoreMember;



class MemberController extends Controller
{
    // INDEX
    public function index() {
        $members = User::members()->get();
        return view('admin.members.index')->with(['members' => $members]);
    }

    // CREATE
    public function create() {
        return view('admin.members.create');
    }

    // EDIT
    public function edit(User $user) {
        $pricings = Pricing::available()->get();
        return view('admin.members.edit')->with(['member' => $user, 'pricings' => $pricings]);
    }

    // STORE
    public function store(StoreRequest $request) {
        $data = $request->validated();


        // Create user
        $temporary_password = Str::random(10);
        $user = User::create([
            'role'               => 'member',
            'firstname'          => $data['firstname'],
            'lastname'           => $data['lastname'],
            'email'              => $data['email'],
            'phone'              => $data['phone'],
            'address'            => $data['address'],
            'city'               => $data['city'],
            'postal_code'        => $data['postal_code'],
            'address_complement' => $data['address_complement'],
            'country'            => $data['country'],
            'phone'              => $data['phone'],
            'password'           => Hash::make($temporary_password),
            'password_expires_at'=> now(),
        ]);
        $user->save();

        if($data['email_verified']) {
            $user->email_verified_at = now();
            $user->save();
        }


        // Send email
        Mail::send(new StoreMember($user, $temporary_password));

        return redirect()->route('admin.members.index')->with(['success' => 'Membre créé avec succès']);
    }

    // UPDATE
    public function update(UpdateRequest $request, User $user) {
        $data = $request->validated();

        $user->update($data);

        return redirect()->route('admin.members.index')->with('success', 'Membre modifié avec succès');
    }

    // UPDATE PFP
    public function updatePfp(PfpRequest $request, User $user) {
        $data = $request->validated();

        // Supprime l'ancienne photo de profil
        if ($user->pfp_path) {
            Storage::delete($user->pfp_path);
            $user->update(['pfp_path' => null]);
        }

        // Enregistre la nouvelle photo de profil
        if(isset($data['pfp']))
        {
            $path = $data['pfp']->store('public/users/pfps');
            $user->update(['pfp_path' => $path]);
        }

        return redirect()->back()->withInput()->with(['success' => 'Photo de profil modifiée avec succès']);
    }

    // DOWNLOAD PFP
    public function downloadPfp(User $user) {
        $path = $user->pfp_path;
        return Storage::download($path);
    }
    
    // UPDATE DOCUMENTS
    public function updateDocuments(DocumentsRequest $request, User $user) {
        $data = $request->validated();

        $documents = $user->documents;
        foreach ($documents as $document) {
            Storage::delete($document->path);
            $document->delete();
        }

        if(isset($data['documents']))
        {
            foreach($data['documents'] as $document) {
                $path = $document->store('public/users/documents');
                $user->documents()->create([
                    'filename'  => $document->getClientOriginalName(),
                    'path'      => $path,
                    'type'      => $document->getMimeType(),
                    'size'      => $document->getSize(),
                    'extension' => $document->extension(),
                ]);
            }
        }


        return redirect()->back()->withInput()->with(['success' => 'Documents modifiés avec succès']);
    }

    // DOWNLOAD DOCUMENTS
    public function downloadDocuments(User $user) {

        $zip = new ZipArchive;
        $zipFileName = $user->firstname.'_'.$user->lastname.'_documents.zip';
       

        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE) {
            
            foreach ($user->documents as $document) {
                $zip->addFile(storage_path('app/'.$document->path), $document->filename);
            }
            $zip->close();

            return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
        } else {
            return "Failed to create the zip file.";
        };

    }

    // SOFT DELETE
    public function softDelete(User $user) {
        $user->softDelete();
        return redirect()->route('admin.members.index')->with(['success' => 'Membre mis à la corbeille avec succès']);   
    }

    // RESTORE
    public function restore(User $user) {
        $user->restore();
        return redirect()->route('admin.members.index')->with(['success' => 'Membre restauré avec succès']);
    }

    // DELETE
    public function delete(User $user) {
        // Supprime la photo de profil
        if ($user->pfp_path) {
            Storage::delete($user->pfp_path);
        }

        // Supprime les documents
        $documents = $user->documents;
        foreach ($documents as $document) {
            Storage::delete($document->path);
            $document->delete();
        }

        $user->delete();
        return redirect()->route('admin.members.index')->with(['success' => 'Membre supprimé avec succès']);
    }

    // ADD PLAN
    public function addPlan(PlanRequest $request, User $user) {
        $data = $request->validated();

        $pricing = Pricing::findOrFail($data['pricing_id']);

        $start_date = Carbon::parse($data['start_date']);
        $expiration_date = $start_date->addDays(30);

        $plan = Plan::create([
            'user_id'          => $user->id,
            'pricing_id'       => $pricing->id,
            'start_date'       => $data['start_date'],
            'expiration_date'  => $expiration_date,
            'nutrition_option' => $data['nutrition_option'],
            'sessions_left'    => $pricing->nbr_sessions,
        ]);

        return redirect()->back()->with(['success' => 'Abonnement ajouté avec succès']);
    }

    // EXPIRE PLAN
    public function expirePlan(Plan $plan) {
        $plan->update(['expiration_date' => now()->subDay()]);
        return redirect()->back()->with(['success' => 'Abonnement expiré avec succès']);
    }

    // DELETE PLAN
    public function deletePlan(Plan $plan) {
        $plan->delete();
        return redirect()->back()->with(['success' => 'Abonnement supprimé avec succès']);
    }

    // ADD WORKOUT
    public function addWorkout(WorkoutRequest $request, User $user) {
        $data = $request->validated();

        for($i = 0; $i < $data['nbr_sessions']; $i++) {
            Workout::create([
                'user_id' => $user->id,
                'plan_id' => null,
                'date'    => null,
                'status'  => false,
            ]);
        }

        return redirect()->back()->with(['success' => 'Séances ajoutées avec succès']);
    }

    // DELETE WORKOUT
    public function deleteWorkout(Workout $workout) {
        $workout->delete();
        return redirect()->back()->with(['success' => 'Séance supprimée avec succès']);
    }

    
}
