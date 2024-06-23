<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

    Route::get('/login','AdminController@login');
    Route::post('/login','AdminController@actionlogin');
    Route::group(['middleware'=>['admin']],function(){
        Route::get('dashboard','AdminController@dashboard');
        Route::get('hcms-dashboard','HCMSController@dashboard');

        Route::get('hcms-profile','HCMSController@profile');
        Route::get('logout','AdminController@logout');
        Route::get('account-admin','AdminController@AccountAdmin');
        Route::match(['get','post'],'update-password','AdminController@UpdateAdminPassword');
        Route::match(['get','post'],'check-current-password','AdminController@CheckAdminPassword');
        Route::match(['get','post'],'update-details','AdminController@UpdateAdminDetails');
        Route::get('Assign-Role-Permission','AdminController@AssignRolePermission');
        Route::match(['get','post'],'assign-role/{id?}','AdminController@AssignRole');
        Route::match(['get','post'],'reset-password/{id?}','AdminController@ResetPassword');
        Route::match(['get','post'],'update-role/{id}','AdminController@UpdateRole');
        Route::match(['get','post'],'Add-dummy-wallet/{id}','AdminController@AddDummyWallet');
        Route::get('dummy-invoice','AdminController@DummyInvoice');
        Route::match(['get','post'],'AddEdit-dummy-invoice','AdminController@AddEditDummyinvoice');
        Route::get('view-dummy-invoice/{id}','AdminController@ViewDummyInvoice');

        Route::controller(\LocationController::class)->group(function(){
            Route::get('state','state');
            Route::post('update-state-status', 'UpdatestateStatus');
            Route::get('district','district');
            Route::post('update-district-status', 'UpdatedistrictStatus');
            Route::get('city','city');
            Route::post('update-city-status', 'UpdatecityStatus');
            Route::get('add-edit-city','create');
            Route::post('add-edit-city','AddEditCity');
        });

        Route::controller(\CommissionReqisatitionController::class)->group(function(){
               Route::get('state-commsion-req','StateCommissionReqAmou');
               Route::match(['get','post'],'add-edit-comm-req-state/{id?}','AddEditCommReqAmState');
               Route::get('district-commsion-req','DistrictCommissionReqAmou');
               Route::match(['get','post'],'add-edit-comm-req-district/{id?}','AddEditCommReqAmdistrict');
               Route::get('city-commsion-req','CityCommissionReqAmou');
               Route::match(['get','post'],'add-edit-comm-req-city/{id?}','AddEditCommReqAmcity');
               Route::get('healthcard-commsion-req','healthcardCommissionReqAmou');
               Route::match(['get','post'],'add-edit-comm-req-healthcard/{id?}','AddEditCommReqAmhealthcard');
               Route::get('hospital-commsion-req','HospitalCommission');
               Route::match(['get','post'],'add-edit-hospital-comm-per/{id?}','AddEdithospitalcommper');
               Route::get('ClinicDoctor-commsion-req','ClinicDoctorCommission');
               Route::match(['get','post'],'add-edit-ClinicDoctor-comm-per/{id?}','AddEditClinicDoctorcommper');
               Route::get('Pathology-commsion-req','PathologyCommission');
               Route::match(['get','post'],'add-edit-Pathology-comm-per/{id?}','AddEditPathologycommper');
               Route::get('ambulance-commsion-req','ambulanceCommission');
               Route::match(['get','post'],'add-edit-ambulance-comm-per/{id?}','AddEditambulancecommper');

        });

        Route::controller(\StateHeadHCMSController::class)->group(function(){
            Route::get('state-head-hcms','index');
            Route::get('Add-state-head-hcms','create');
            Route::post('Add-state-head-hcms','save');
            Route::get('Edit-state-head-hcms/{id}','create');
            Route::post('Edit-state-head-hcms/{id}','update');
            Route::Post('ChangeStatus-state-head-hcms', 'ChangeStatus');
            Route::get('Delete-state-head-hcms/{id}','delete');
            Route::get('account-statehead','AccountStateHead');
            Route::get('account-statehead-admin/{id}','AccountStateHeadadmin');
            Route::get('view-bill-state/{id}','viewbillstate');
            Route::get('state-invoice','stateInovice');
        });
        Route::controller(\StatusUpdateHealthCardController::class)->group(function(){

            Route::get('inactive-healthcard','InactiveHealth');
            Route::Post('UpdateAccountStatus', 'updatestatus');

        });

        Route::controller(\DistrictHeadHCMSController::class)->group(function(){
            Route::get('district-head-hcms','index');
            Route::get('Add-district-head-hcms','create');
            Route::post('Add-district-head-hcms','save');
            Route::get('Edit-district-head-hcms/{id}','create');
            Route::post('Edit-district-head-hcms/{id}','update');
            Route::Post('ChangeStatus-district-head-hcms', 'ChangeStatus');
            Route::get('Delete-district-head-hcms/{id}','delete');
            Route::get('account-districthead','AccountStateHead');
            Route::get('account-districthead-admin/{id}','AccountdistrictHeadadmin');
            Route::get('view-bill-district/{id}','viewbilldistrict');
            Route::get('district-invoice','DistrictInovice');
        });
        Route::controller(\CityHeadHCMSController::class)->group(function(){
            Route::get('city-head-hcms','index');
            Route::get('Add-city-head-hcms','create');
            Route::post('Add-city-head-hcms','save');
            Route::get('Edit-city-head-hcms/{id}','create');
            Route::post('Edit-city-head-hcms/{id}','update');
            Route::Post('ChangeStatus-city-head-hcms', 'ChangeStatus');
            Route::get('Delete-city-head-hcms/{id}','delete');
            Route::get('account-cityhead','AccountStateHead');
            Route::get('account-cityhead-admin/{id}','AccountcityHeadadmin');
            Route::get('view-bill-city/{id}','viewbillcity');
            Route::get('city-invoice','cityInovice');
        });
        Route::controller(\HealthCardHCMSController::class)->group(function(){
            Route::get('health-card-type','HealthCardType');
            Route::match(['get','post'],'add-edit-health-card-type/{id?}','AddEditHealthCardType');
            Route::get('Delete-health-card-type/{id}','deleteHealthCardType');
            Route::get('Delete-state-head-hcms/{id}','delete');
            Route::get('create-health-card','HealthCard');
            Route::match(['get','post'],'add-edit-health-card/{id?}','CreateHealthCard');
            Route::Post('upate-health-card-list-status', 'ChangeHealthCardListStatus');
            Route::get('Delete-health-card-list/{id}','deleteHealthCardList');
            Route::get('download-health-card/{id}','downloadhealthcard');
            Route::get('Health-card-view','downloadhealthcards');
            Route::get('download-health-card/{id}/generate','generateHealthcard');
            Route::get('health-card-customer-list','HealthcardCustomerList');
            Route::match(['get','post'],'Update-health-card/{id?}','UpdateHealthCard');
            Route::get('assign-card-customer-list','AssignCardCustomerList');
            Route::get('account-healthcard','AccountStateHead');
            Route::get('account-healthcard-admin/{id}','AccountHealthCardAdmin');
            Route::get('health-wallet-Transection-History','HealthwalletTransectionHistory');
            Route::get('view-bill-healthcard/{id}','viewbillhealthcard');
            Route::get('Health-card-user-invoice','HealthCardUserInovice');
        });

        Route::controller(\WithDrawAmountController::class)->group(function(){
            Route::get('withdraw-request','Withdrawrequest');
            Route::post('withdrwawalletamount','withdrwawalletamount');
            Route::get('approve_withdraw_amount/{id}','approvewithdrawamount');
            Route::get('approve_withdraw_amount','ApprovelWithdrawSection');
            Route::get('withdraw-Histroy','WithDrawHistory');
            Route::get('Withdraw-charges','WithDrawCharges');
            Route::post('transfer-to-dummyWallet','TransferToDummyWallet');

        });
        Route::controller(\HospitalManagementController::class)->group(function(){
             Route::get('hospital-dashboard','HospitalDashboard');
               Route::get('hospital-List','HospitalList');
               Route::match(['get','post'],'Add-Edit-Hospital/{id?}','AddEditHospital');
               Route::get('Delete-hospital/{id}','DeleteHospital');
               Route::Post('upate-hospital-list-status', 'ChangeHospitalListStatus');
               Route::match(['get','post'],'hospital-commisison-reciver/{id}','HospitalCommissionReciver');

               Route::get('HealthCard-customer-Details','HealthCardCustomerDetails');
               Route::match(['get','post'],'HealthCard-customer-Details-Search', 'HealthCardCustomerDetailSearch');
               Route::get('HealthCard-customer-view/{id}','HealthCardCustomerDetailsview');
               Route::match(['get','post'],'add-paitent-details/{id?}', 'AddPaitentDetails');
               Route::get('paitent-list','paitentlist');
               Route::get('paitent-disharge-list','paitentdishargelist');
               Route::get('paitent-disharge-list_details/{id}','paitentdishargelistdetails');
               Route::get('view-paitent-bill/{id}','viewPaitentbill');
               Route::get('hospital-wise_paitent-list/{id}','HospitalWisePaitentList');
               Route::get('view-hospital-details/{id}','ViewHospitalDetails');
               Route::get('hospital-Invoice-Customer-wise','HositalInovieCustomerWise');
               Route::get('payment-recipt','PaymentReciptComp');
               Route::match(['get','post'],'Hospital-More-Details/{id}','HospitalMultiImages');
               Route::post('Hospital-Details/{id}','HospitalMoreDetails');
               Route::get('delete-image/{id}', 'DeleteImage');
               Route::match(['get','post'],'Hospital-Additional-Details','HospitalAdditionalDetails');
               Route::post('Hospital-Details-Additional','HospitalDetailsAdditional');
               Route::post('ADD-Hospital-Specialization/{id}','AddHospitalSpecializa');
               Route::get('delete-specializationHospitalList/{id}', 'DeleteSpecialization');
               Route::post('Hospitals-Details-Specialization','HospitalDetailsSpecialization');
               Route::get('Online-Appointent-List','OnlineBookApplist');
               Route::match(['get','post'],'Edit-online-appointent/{id?}','Editonlineappointent');
               Route::get('Appointent-Accepted-List','OnlineBookaccpetedlist');
               Route::get('Appointent-Rejected-List','OnlineBookrejectedlist');

        });
        Route::controller(\DoctorController::class)->group(function(){
            Route::get('Doctor-dashboard','DoctorDashboard');
              Route::get('Doctor-List','DoctorList');
              Route::get('view-Doctor-details/{id}','ViewDoctorList');
              Route::match(['get','post'],'Add-Edit-Doctor/{id?}','AddEditDoctor');
              Route::get('Delete-Doctor/{id}','DeleteDoctor');
              Route::Post('upate-Doctor-list-status', 'ChangeDoctorListStatus');
              Route::match(['get','post'],'Doctor-More-Details/{id}','DoctorMultiImages');
              Route::get('delete-image/{id}', 'DeleteImage');
              Route::post('ADD-Doctor-Specialization/{id}','AddDoctorSpecializa');
              Route::get('delete-specializationDoctorList/{id}', 'DeleteSpecialization');
              Route::post('Doctor-Details/{id}','DoctorMoreDetails');
              Route::get('Doctor-wise_paitent-list/{id}','DoctorWisePaitentList');
              Route::match(['get','post'],'Doctor-commisison-reciver/{id}','DoctorCommissionReciver');

              Route::get('HCcustomer-Details','HCCustomerDetails');
              Route::match(['get','post'],'HCcustomer-Details-Search', 'HCCustomerDetailSearch');
              Route::get('HCcustomer-view/{id}','HCCustomerDetailsview');
              Route::match(['get','post'],'add-Doc-paitent-details/{id?}', 'AddDocPaitentDetails');
              Route::get('doc-paitent-list','paitentlist');
              Route::get('doc-paitent-disharge-list','docpaitentdishargelist');
              Route::get('doc-paitent-disharge-list_details/{id}','paitentdishargelistdetails');
              Route::get('view-doc-paitent-bill/{id}','viewPaitentbill');
              Route::get('view-paitent-medicine-slip/{id}','viewmedicineslip');
              Route::get('doc-payment-recipt','docPaymentReciptComp');
              Route::match(['get','post'],'Doctor-Additional-Details','DoctorAdditionalDetails');
              Route::post('Doctor-Details-Additional','DoctorDetailsAdditional');
              Route::post('Doctor-Details-Specialization','DoctorDetailsSpecialization');
              Route::get('Doc-Online-Appointent-List','DocOnlineBookApplist');
              Route::match(['get','post'],'Doc-Edit-online-appointent/{id?}','DocEditonlineappointent');
              Route::get('Doc-Appointent-Accepted-List','OnlineBookaccpetedlist');
              Route::get('Doc-Appointent-Rejected-List','OnlineBookrejectedlist');
              Route::get('ClinicDoctor-Invoice-Customer-wise','ClinicDoctorCustomerWiseInovice');
       });
       Route::controller(\AmbulanceController::class)->group(function(){
        Route::get('Ambulance-dashboard','AmbulanceDashboard');
        Route::get('Ambulance-List','AmbulanceList');
        Route::match(['get','post'],'Add-Edit-Ambulance/{id?}','AddEditAmbulance');
        Route::get('Delete-Ambulance/{id}','DeleteAmbulance');
        Route::Post('upate-Ambulance-list-status', 'ChangeAmbulanceListStatus');
        Route::get('Ambulance-Km-Charges','AmbulanceKmCharges_list');
        Route::get('Ambulance-Km-Charges/{id}','AmbulanceKmCharges_listedit');
        Route::post('Ambulance-Km-Charges/{id}','AmbulanceKmChargesave');
       });
       Route::controller(\DriverController::class)->group(function(){
        Route::get('Driver-dashboard','DriverDashboard');
        Route::get('Driver-list','DriverList');
        Route::match(['get','post'],'Add-Edit-Driver/{id?}','AddEditDriver');
        Route::get('Delete-Driver/{id}','DeleteDriver');
        Route::Post('upate-Driver-list-status', 'ChangeDriverListStatus');
       });
       Route::controller(\AssignAmbulanceController::class)->group(function(){
        Route::get('AssignAmbulance-list','AssignAmbulanceList');
        Route::match(['get','post'],'Add-Edit-AssignAmbulance/{id?}','AddEditAssignAmbulance');
        Route::get('Delete-AssignAmbulance/{id}','DeleteAssignAmbulance');
        Route::Post('upate-AssignAmbulance-list-status', 'ChangeAssignAmbulanceListStatus');
       });
       Route::controller(\PathologyController::class)->group(function(){
        Route::get('Pathology-Dashboard','PathologyDashboard');
        Route::get('Pathology-List','PathologyList');
        Route::get('view-pathology-details/{id}','ViewPathologyDetails');
        Route::match(['get','post'],'ADD-Edit-Pathology/{id?}','ADDEditPathology');
        Route::get('Delete-Pathology/{id}','DeletePathology');
        Route::Post('upate-pathology-list-status', 'ChangePathologyListStatus');

        Route::get('Pathtesttype','Pathtesttype');
        Route::match(['get','post'],'add-edit-Pathtesttype/{id?}','AddEditPathtesttype');
        Route::Post('upate-Pathtesttype-status', 'ChangePathtesttypeStatus');
        Route::get('Delete-Pathtesttype/{id?}','DeletePathtesttype');

        Route::get('Path-HealthCard-customer','PathHealthCardcustomer');
        Route::match(['get','post'],'path-HC-cust-Details-Search', 'PathHealthCardCustomerDetailSearch');
        Route::get('pathHealthCard-Cust-view/{id}','PathHCCustomerDetailsview');
        Route::match(['get','post'],'add-pathpaitent-details/{id?}', 'AddpathPaitentDetails');
        Route::get('Pathology-Paitent-list','pathpaitentlist'); 
        Route::match(['get','post'],'add-path-paitent-test/{id}', 'AddPathpatienttest');
        Route::get('Delete-Paitent-Test-Type/{id?}','DeletePaitenttesttype');
        Route::get('testtype_wise_amount/{id}','testtype_wise_amount');

        Route::get('paitent-testcom-list','paitentTestcompletelist');
        Route::get('paitent-disharge-list_details/{id}','paitentTestCompletedetails');
        Route::get('view-pathology-paitent-bill/{id}','viewPathologyPaitentbill');
        Route::get('Pathology-wise-customer-Invoice','PathologyCustomerWiseInovice');
        Route::match(['get','post'],'pathology-commisison-reciver/{id}','PathologyCommissionReciver');
       
        Route::get('Path-payment-recipt','PathPaymentReciptComp');
        Route::get('pathology-wise_paitent-list/{id}','PathologyWisePaitentList');


       });
       Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index']);
       Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'store']);
       Route::get('banners', 'BannerController@Banners');
       Route::match(['get', 'post'], 'add-banner-image/{id?}', 'BannerController@AddBannerImage');
       Route::get('Delete-banner/{id}', 'BannerController@DeleteBanner');

       Route::get('Blog', 'BlogController@blog');
       Route::match(['get', 'post'], 'add-edit-blog/{id?}', 'BlogController@Addblog');
       Route::get('Delete-blog/{id}', 'BlogController@Deleteblog');

        Route::controller(\GiftOfferedHealthcardController::class)->group(function(){
             Route::get('HealthCard-gift-Offered','HealthCardgiftOfferedlist');
             Route::get('gift-offered-userwise/{id}','giftoffereduserwise');
             Route::get('gift-Offered-List','giftOfferedlist');
        });

        Route::controller(\VideoCallMeetingController::class)->group(function(){
            Route::get('Request-VideoCall-Doctor','RequestVideoCallDoctor');
            Route::match(['get','post'],'Add-Edit-VideoCallRequest/{id}','AddEditVideoCallRequest');
            Route::match(['get','post'],'Add-Edit-VideoCallLink/{id?}','AddEditVideoCallLink');
            Route::get('Video-callApprovel-List','VideocallApprovelList');
       });

        Route::controller(\SpecializationHospitalController::class)->group(function(){
                   Route:: get('Hospital-Specialization','HospitalSpecialization');
                   Route::match(['get','post'],'Add-Edit-Specialization/{id?}','AddEditSpecialization');
                   Route::get('Delete-Specialization/{id?}','DeleteSpecialization');
        });
        Route::controller(\ReviewController::class)->group(function(){
            Route::match(['get','post'],'Add-Edit-Review/{id}','AddEditReview');
            Route::match(['get','post'],'Add-Edit-DReview/{id}','AddEditDoctorReview');
            Route::match(['get','post'],'Add-Edit-PReview/{id}','AddEditPathologyReview');
         });

        Route::controller(\BrandController::class)->group(function(){
            Route::get('brands','brand');
            Route::match(['get','post'],'add-edit-brands/{id?}','AddEditBrand');
            Route::Post('upate-brands-status', 'ChangeBrandsStatus');
            Route::get('Delete-brands/{id?}','DeleteBrand');
       });


        Route::controller(\MedicineController::class)->group(function(){
                Route::get('medicine-type','MedicineType');
                Route::match(['get','post'],'add-edit-medicinetypes/{id?}','AddEditMedicinieType');
                Route::Post('upate-medicinetypes-status', 'ChangeMedicineTypesStatus');
                Route::get('Delete-medicinetypes/{id?}','DeleteMedicineTypes');

                Route::get('medicine','MedicineList');
                Route::match(['get','post'],'add-edit-medicine/{id?}','AddEditMedicinie');

        });

        Route::controller(\MedicineCategoryController::class)->group(function(){
                Route::get('medicine-category','MedicineCategory');
                Route::match(['get','post'],'add-edit-medicine-category/{id?}','AddEditMedicineCategory');
                Route::Post('upate-categorys-status', 'ChangeMCategoryStatus');
                Route::get('Delete-categorys/{id}','DeleteMCategory');

                Route::get('medicine-subcategory' ,'MedicineSubCategory');
                Route::match(['get','post'],'add-edit-medicine-subcategory/{id?}','AddEditMedicineSubCategory');
                Route::Post('upate-subcategorys-status', 'ChangeMSubcategoryStatus');
                Route::get('Delete-subcategorys/{id}','DeleteMSubcategory');
        });
        Route::controller(\ReportController::class)->group(function(){
            Route::get('Hospital-Comm-Report','hospital_report');
            Route::get('StateHead-Comm-Report','state_report');
            Route::get('DistrictHead-Comm-Report','DistrictReport');
            Route::get('CityHead-Comm-Report','CityHeadReport');
            Route::get('HealthCard-Comm-Report','HealthCardReport');
            Route::get('ClinicDoctor-Comm-Report','ClinicDoctorReport'); 
            Route::get('Pathology-Comm-Report','PathologyReport');
            Route::get('Level-Income-Histroy-Report','LevelIncomeHistoryReport');   
           
       });

        Route::controller(\OrderOMSController::class)->group(function(){
            Route::get('new-request','Newrequest');
            Route::get('pending-order','PendingOrder');
            Route::get('shipping-order','ShippingOrder');
            Route::get('dispatch-order','dispatchOrder');
            Route::get('delivery-order','deliveryOrder');
            Route::get('out-for-delivery-order','outfordeliveryOrder');
            Route::get('undelivery-order','undeliveryOrder');
            Route::get('cancle-order','cancleOrder');
        });
        Route::get('tree-structure','TreeController@index');
        Route::get('tree-structure-show','TreeController@show');
        Route::get('healthcarduser','HealthCardReportController@healthcarduser');

    });

     // api start here
     Route::get('Getdist-state-wise/{stateid}','APIController@getdiststatewise');
     Route::get('getcitydistwise/{distid}','APIController@getcitydistwise');
     Route::get('getamountcardwise/{distid}','APIController@getamountcardwise');
     Route::get('getsubcategory/{cate_id}','APIController@getsubcategory');
     // end here

});

Route::namespace('App\Http\Controllers\Front')->group(function () {

    Route::controller(\HomeController::class)->group(function(){
        Route::get('/', 'index');
        Route::get('about','about');
        Route::get('contact','contact');
        Route::post('search-with-home','searchwithhome');
    });

    Route::controller(\DocterController::class)->group(function(){
        Route::get('doctors', 'doctors');
        Route::get('Doctor-Details/{slug}', 'DoctorDetails');
        Route::get('Book-Doctor-Appointent/{slug}', 'BookAppointent');
        Route::post('Book-Doctor-Appointent/{slug}', 'BookAppointentsave');
        Route::match(['get','post'],'Register-Doctor','OnlineReqistationDoctor');
    });
   
    Route::controller(\HospitalController::class)->group(function(){
        Route::get('hospital', 'hospital');
        Route::post('hospital', 'hospitalsearch');

        Route::get('Hospital-Details/{name}', 'HospitalDetails');
        Route::get('Book-Appointent/{name}', 'BookAppointent');
        Route::post('Book-Appointent/{name}', 'BookAppointentsave');
        Route::match(['get','post'],'Register-Hospital','RegisterHospital');

    });
    Route::controller(\AmbulanceController::class)->group(function(){
        Route::get('ambulance', 'ambulance');
        Route::match(['get','post'],'Register-Ambulance','RegisterAmbulance');
        Route::get('Book-Ambulance', 'BookAmbulance');
    });
    Route::controller(\HealthCardController::class)->group(function(){
        Route::get('Health-Card', 'HealthCardType');
        Route::match(['get','post'],'HealthCard-Type-Wise-From/{slug}','HealthCardTypeWiseFrom');
    });
    Route::controller(\PathologyController::class)->group(function(){
        Route::get('Pathology', 'Pathology');
        Route::get('Pathology-Details/{slug}', 'PathologyDetails');
        Route::match(['get','post'],'Register-Pathology','OnlineReqistationPathology');
    });

});


Route::namespace('App\Http\Controllers\Front\Ecommerce')->group(function () {
    Route::controller(\EcomHomeController::class)->group(function(){
        Route::get('E-Commerce', 'ECommerceindex');

    });
});
