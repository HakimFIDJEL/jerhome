import{s as x}from"./swal-Bt6ici_8.js";import{n as c}from"./notyf-D_y3dwLD.js";import"./jquery-CP0fMIbo.js";import"./_commonjsHelpers-Cpj98o6Y.js";import"./sweetalert2.all-B9kxGEux.js";import"./notyf.min-DaJKEBVE.js";let d,n,g=$("#wizard_nutrition").data("nutrition-price"),a=0,p=$("#wizard-cart-list"),l=p.find("#cart-pricing"),b=p.find("#cart-nutrition"),u=p.find("#cart-reduction"),C=p.find("#cart-total"),s=$("#cart-reduction-form"),e=$("#cart-payment-form"),w=e.find('input[type="hidden"]#pricing_id'),P=e.find('input[type="hidden"]#nutrition_option'),k=e.find('input[type="hidden"]#reduction_id'),F=e.find('input[type="hidden"]#total_price'),i=0;$(document).ready(function(){setTimeout(function(){$("#smartwizard").smartWizard("goToStep",0),$("#smartwizard").find(".nav-link").removeClass("done"),R(),v()},0),$(document).on("click",".pricing-selection button",function(){let t=$(this).closest(".pricing-selection");t.addClass("border-primary").siblings().removeClass("border-primary"),d=t.data("pricing"),$(this).prop("disabled",!0),$(".pricing-selection").not(t).find("button").prop("disabled",!1),z(t.data("pricing"))}),$(document).on("click",".nutrition-selection button",function(){let t=$(this).closest(".nutrition-selection");a==0?(t.addClass("border-primary"),$(this).text("Déselectionner"),$(this).removeClass("btn-primary").addClass("btn-secondary"),a=1):(t.removeClass("border-primary"),$(this).text("Sélectionner"),$(this).removeClass("btn-secondary").addClass("btn-primary"),a=0),S()}),$(document).on("click","#cart-reduction-remove",function(){n=null,y(),$("#cart-reduction-form").css("display","block"),$(this).css("display","none")}),$(document).on("submit","#cart-reduction-form",function(t){t.preventDefault();let r=$(this),f=r.serialize();r.find('button[type="submit"]'),h(),$.ajax({url:r.attr("action"),type:r.attr("method"),headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},data:f}).done(function(o){switch(o.status){case"success":n=o.reduction,y(),r.css("display","none"),$("#cart-reduction-remove").css("display","block");break;case"error":c.error(o.message);break;default:c.error("Une erreur est survenue lors de la validation du code promo.");break}}).fail(function(o){o.responseJSON?c.error(o.responseJSON.message??"Une erreur est survenue !"):c.error("Une erreur est survenue !")}).always(function(){r.find("input").val(""),v()})}),$(document).on("submit","#cart-payment-form",function(t){_(),h()}),$("#smartwizard").on("leaveStep",function(t,r,f,o,B){if(f===0&&!d)return x.fire({icon:"error",title:"Sélection d'abonnement",text:"Veuillez sélectionner un abonnement avant de continuer.",showConfirmButton:!1,showCancelButton:!1,timer:2500}),!1})});function z(t){l.find(".title").text(t.title),l.find(".subtitle").text(t.subtitle),l.find(".price").text(t.price+" €"),l.css("display","flex"),m()}function S(){a==1?b.css("display","flex"):b.hide(),m()}function y(){n?(u.find(".subtitle").text(n.code),u.find(".price").text("-"+n.percentage+" %"),u.css("display","flex")):u.hide(),m()}function h(){s.find('button[type="submit"]').prop("disabled",!0),s.find("span.cart-form-text").hide(),s.find("span.cart-form-loader").show()}function v(){s.find('button[type="submit"]').prop("disabled",!1),s.find("span.cart-form-text").show(),s.find("span.cart-form-loader").hide()}function R(){e.find('button[type="submit"]').prop("disabled",!1),e.find("span.span-form-text").css("display","flex"),e.find("span.span-form-loader").hide()}function _(){e.find('button[type="submit"]').prop("disabled",!0),e.find("span.span-form-text").hide(),e.find("span.span-form-loader").show()}function m(){a==1?i=d.price+g:i=d.price,n&&(i=i-i*n.percentage/100),i=Math.round(i*100)/100;let t=i;C.find(".price").text(t+" €"),w.val(d.id),P.val(a),k.val(n?n.id:""),F.val(t)}
