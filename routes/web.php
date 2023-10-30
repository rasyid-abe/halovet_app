<?php

use App\Ads as ads;
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

Route::get('/', 'IndexController@index');
Route::get('/allpetapi','PemeriksaanController@apipet');
Auth::routes();
Route::get('logout', function() {
    Auth::logout();
    return redirect('/');
});
Route::get('register/verify/{token}', 'Auth\RegisterController@verify'); 
Route::get('/register/dokter', function() {
    $ad = ads::where('adsid',5)->first();
    return view('auth.registerdokter')->with(compact('ad'));
});

Route::get('artikel/{slug}','ArticleController@articleshow');
Route::get('artikel','ArticleController@articleblog');
Route::get('kategori','ArticleController@categoryblog');
Route::get('kategori/{slug}','ArticleController@categoryshow');
Route::get('penyakit','PenyakitController@penyakitlist');
Route::get('penyakit/{slug}','PenyakitController@penyakitshow');

Route::get('konsultasi/baru', 'KonsultasiController@newkonsul')->middleware('auth');
Route::post('konsultasi/baru/save', 'KonsultasiController@savekonsul')->middleware('auth');
Route::get('konsultasi', 'KonsultasiController@konsultasip');
Route::get('konsultasi/{slug}', 'KonsultasiController@viewkonsul');
Route::get('konsultasi/{slug}/edit', 'KonsultasiController@editkonsul')->middleware('auth');
Route::post('konsultasi/{slug}/save', 'KonsultasiController@editsave')->middleware('auth');

Route::post('editbalasan/{id}/save','JawabanController@editedjaw')->middleware('auth');
Route::get('editbalasan/{id}','JawabanController@editjaw')->middleware('auth');
Route::post('balas/{slug}','JawabanController@balased')->middleware('auth');

Route::get('page/{slug}','PageController@showpage');
Route::get('contact','ContactController@pagecontact');
Route::post('contact/send','ContactController@pagesend');

Route::get('dashboard','IndexController@dashboard')->middleware('auth')->name('dashboard');

Route::post('dashboard/changeimg','IndexController@changeindeximg')->middleware('auth');
Route::get('dashboard/post/new','IndexController@doknewpost')->middleware('auth');
Route::post('dashboard/post/new/save','IndexController@doksavepost')->middleware('auth');
Route::get('dashboard/post','IndexController@dokpost')->middleware('auth');
Route::get('dashboard/post/edit/{id}','IndexController@dokeditpost')->middleware('auth');
Route::post('dashboard/post/update','IndexController@dokupdatepost')->middleware('auth');
Route::get('dashboard/post/delete/{slug}','IndexController@dokdeletepost')->middleware('auth');

Route::get('dashboard/peliharaan','PeliharaanController@peliharaanindex')->middleware('auth');
Route::get('dashboard/peliharaan/new','PeliharaanController@newpel')->middleware('auth');
Route::post('dashboard/peliharaan/new/save','PeliharaanController@insertpel')->middleware('auth');
Route::get('dashboard/peliharaan/edit/{petcode}','PeliharaanController@editpel')->middleware('auth');
Route::post('dashboard/peliharaan/update','PeliharaanController@editedpel')->middleware('auth');
Route::get('dashboard/peliharaan/detail/{petcode}','PeliharaanController@petdetail')->middleware('auth');
Route::get('dashboard/peliharaan/delete/{petcode}','PeliharaanController@deletepel')->middleware('auth');

Route::get('dashboard/pemeriksaan','PemeriksaanController@daspemeriksaan')->middleware('auth');
Route::get('dashboard/pemeriksaan/new','PemeriksaanController@newpemeriksaan')->middleware('auth');
Route::post('dashboard/pemeriksaan/new/save','PemeriksaanController@savepemeriksaan')->middleware('auth');
Route::get('dashboard/pemeriksaan/edit/{percode}','PemeriksaanController@editpemeriksaan')->middleware('auth');
Route::post('dashboard/pemeriksaan/update','PemeriksaanController@editedpemeriksaan')->middleware('auth');
Route::get('dashboard/pemeriksaan/detail/{percode}','PemeriksaanController@detailpemeriksaan')->middleware('auth');
Route::get('dashboard/pemeriksaan/delete/{percode}','PemeriksaanController@deletepemeriksaan')->middleware('auth');

Route::get('karir/','LowonganController@indexlowongan');
Route::get('karir/{lokslug}','LowonganController@detailowongan');
/*
|--------------------------------------------------------------------------
| User Profile Route
|--------------------------------------------------------------------------
*/

Route::get('user/{id}', 'UserController@show');
Route::get('dokter','UserController@dokterall');
/*
|--------------------------------------------------------------------------
| User Setting Route
|--------------------------------------------------------------------------
*/
Route::get('setting', 'UserController@setting')->middleware('auth');
Route::post('setting/save', 'UserController@savesetting')->middleware('auth');
Route::get('setting/dokter', 'UserController@settingdokter')->middleware('auth');
Route::post('setting/dokter/save', 'UserController@settingdoktersave')->middleware('auth');
Route::get('setting/reset/','UserController@reset')->middleware('auth');
Route::post('setting/reset/','UserController@reseted')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin X
|--------------------------------------------------------------------------
*/
Route::get('adminix','AdminController@access')->middleware('auth');
Route::get('adminix/ads','AdsController@adindex')->middleware('auth');
Route::post('adminix/ads/update','AdsController@adset')->middleware('auth');
/*
|--------------------------------------------------------------------------
| Admin User
|--------------------------------------------------------------------------
*/
Route::get('adminix/user','UserController@adminalluser')->middleware('auth');
Route::get('adminix/user/new','UserController@adminnewuser')->middleware('auth');
Route::get('adminix/user/edit/{id}','UserController@adminedituser')->middleware('auth');
Route::post('adminix/user/save','UserController@admineditsave')->middleware('auth');
Route::get('adminix/user/delete/{id}','UserController@admindeleteuser')->middleware('auth');
Route::get('adminix/user/detail/{id}','UserController@admindetailuser')->middleware('auth');

Route::get('adminix/user/dokter','UserController@adminalldokter')->middleware('auth');
Route::get('adminix/user/dokter/unverified','UserController@adminalldokterunverified')->middleware('auth');

Route::get('adminix/user/dokter/verify/{id}','UserController@adminverifydokter')->middleware('auth');
Route::get('adminix/user/dokter/unverify/{id}','UserController@adminunverifydokter')->middleware('auth');
Route::post('adminix/user/dokter/verified','UserController@admindokterverified')->middleware('auth');
Route::get('adminix/dokter/delete/{id}','UserController@deletedokters')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Artikel
|--------------------------------------------------------------------------
*/

Route::get('adminix/artikel','ArticleController@allarticle')->middleware('auth');
Route::get('adminix/artikel/new','ArticleController@newarticle')->middleware('auth');
Route::post('adminix/artikel/new/save','ArticleController@savenewarticle')->middleware('auth');
Route::get('adminix/artikel/detail/{id}','ArticleController@detailarticle')->middleware('auth');
Route::get('adminix/artikel/edit/{id}','ArticleController@editarticle')->middleware('auth');
Route::post('adminix/artikel/edit/save','ArticleController@saveeditarticle')->middleware('auth');
Route::get('adminix/artikel/delete/{id}','ArticleController@deletearticle')->middleware('auth');


Route::get('adminix/penyakit','PenyakitController@admindex')->middleware('auth');
Route::get('adminix/penyakit/new','PenyakitController@newpenyakit')->middleware('auth');
Route::post('adminix/penyakit/new/save','PenyakitController@storepenyakit')->middleware('auth');
Route::get('adminix/penyakit/detail/{id}','PenyakitController@viewpenyakit')->middleware('auth');
Route::get('adminix/penyakit/edit/{id}','PenyakitController@editpen')->middleware('auth');
Route::post('adminix/penyakit/edit/save','PenyakitController@savepen')->middleware('auth');
Route::get('adminix/penyakit/delete/{id}','PenyakitController@deletepen')->middleware('auth');

Route::get('adminix/loker','LowonganController@adminindexlowongan')->middleware('auth');
Route::get('adminix/loker/new','LowonganController@adminnewlowongan')->middleware('auth');
Route::post('adminix/loker/new/save','LowonganController@adminsavelowongan')->middleware('auth');
Route::get('adminix/loker/detail/{id}','LowonganController@admindetaillowongan')->middleware('auth');
Route::get('adminix/loker/edit/{id}','LowonganController@admineditlowongan')->middleware('auth');
Route::post('adminix/loker/edit/save','LowonganController@admineditedlowongan')->middleware('auth');
Route::get('adminix/loker/delete/{id}','LowonganController@admindeletelowongan')->middleware('auth');

Route::get('adminix/peliharaan','PeliharaanController@adminindex')->middleware('auth');
Route::get('adminix/peliharaan/detail/{id}','PeliharaanController@detailhewan')->middleware('auth');
Route::get('adminix/peliharaan/edit/{id}','PeliharaanController@edithewan')->middleware('auth');
Route::post('adminix/peliharaan/edit/save','PeliharaanController@editedhewan')->middleware('auth');
Route::get('adminix/peliharaan/delete/{id}','PeliharaanController@deletehewan')->middleware('auth');

Route::get('adminix/pemeriksaan','PemeriksaanController@adminindexs')->middleware('auth');
Route::get('adminix/pemeriksaan/detail/{id}','PemeriksaanController@detailper')->middleware('auth');
Route::get('adminix/pemeriksaan/edit/{id}','PemeriksaanController@adminedit')->middleware('auth');
Route::post('adminix/pemeriksaan/edit/save','PemeriksaanController@adminedited')->middleware('auth');
Route::get('adminix/pemeriksaan/delete/{id}','PemeriksaanController@deleteper')->middleware('auth');

Route::get('adminix/artikel/kategori','ArticleController@allcategory')->middleware('auth');
Route::get('adminix/artikel/kategori/new','ArticleController@newcategory')->middleware('auth');
Route::post('adminix/artikel/kategori/new/save','ArticleController@savenewcategory')->middleware('auth');
Route::get('adminix/artikel/kategori/delete/{id}','ArticleController@deletecategory')->middleware('auth');
Route::get('adminix/artikel/kategori/edit/{id}','ArticleController@editcategory')->middleware('auth');
Route::post('adminix/artikel/kategori/edit/save','ArticleController@editsave')->middleware('auth');

Route::get('adminix/konsultasi/category','KonsulCatController@indexadmin')->middleware('auth');
Route::get('adminix/konsultasi/category/new','KonsulCatController@newcat')->middleware('auth');
Route::post('adminix/konsultasi/category/new/save','KonsulCatController@savecat')->middleware('auth');
Route::get('adminix/konsultasi/category/edit/{id}','KonsulCatController@editcat')->middleware('auth');
Route::post('adminix/konsultasi/category/edit/{id}/save','KonsulCatController@updatecat')->middleware('auth');
Route::get('adminix/konsultasi/category/delete/{id}','KonsulCatController@deletekoncat')->middleware('auth');

Route::get('adminix/konsultasi','KonsultasiController@konsuladmin')->middleware('auth');
Route::get('adminix/konsultasi/close/{id}','KonsultasiController@closekonsul')->middleware('auth');
Route::get('adminix/konsultasi/unclose/{id}','KonsultasiController@unclosekonsul')->middleware('auth');
Route::get('adminix/konsultasi/edit/{id}/','KonsultasiController@editkonsulbyadmin')->middleware('auth');
Route::post('adminix/konsultasi/edit/save','KonsultasiController@savekonsuleditbyadmin')->middleware('auth');
Route::get('adminix/konsultasi/delete/{id}','KonsultasiController@deletekonsulbyadmin')->middleware('auth');

Route::get('adminix/jawabandiskusi','JawabanController@jawabanadmin')->middleware('auth');
Route::get('adminix/jawabandiskusi/edit/{id}/','JawabanController@editjawabanbyadmin')->middleware('auth');
Route::post('adminix/jawabandiskusi/edit/save','JawabanController@savejawabaneditbyadmin')->middleware('auth');
Route::get('adminix/jawabandiskusi/delete/{id}','JawabanController@deletejawabanbyadmin')->middleware('auth');

Route::get('adminix/slider','slidercontroller@slideradmin')->middleware('auth');
Route::get('adminix/slider/new','slidercontroller@slidernew')->middleware('auth');
Route::post('adminix/slider/new/save','slidercontroller@saveslider')->middleware('auth');
Route::get('adminix/slider/edit/{id}/','slidercontroller@editslider')->middleware('auth');
Route::post('adminix/slider/edit/save','slidercontroller@editedslider')->middleware('auth');
Route::get('adminix/slider/delete/{id}','slidercontroller@deleteslider')->middleware('auth');


Route::get('adminix/page','PageController@adminpage')->middleware('auth');
Route::get('adminix/page/new','PageController@newpage')->middleware('auth');
Route::get('adminix/page/detail/{id}','PageController@detailpage')->middleware('auth');
Route::post('adminix/page/new/save','PageController@savepage')->middleware('auth');
Route::get('adminix/page/edit/{id}/','PageController@editpage')->middleware('auth');
Route::post('adminix/page/edit/save','PageController@updatepage')->middleware('auth');
Route::get('adminix/page/delete/{id}','PageController@deletepage')->middleware('auth');

Route::get('adminix/contact','ContactController@admincontact')->middleware('auth');
Route::get('adminix/contact/detail/{id}','ContactController@detailcontact')->middleware('auth');
Route::get('adminix/contact/delete/{id}','ContactController@deletecontact')->middleware('auth');

Route::get('adminix/sidebar','SidebarController@sidebaradmin')->middleware('auth');
Route::get('adminix/sidebar/new','SidebarController@newside')->middleware('auth');
Route::post('adminix/sidebar/new/save','SidebarController@saveside')->middleware('auth');
Route::get('adminix/sidebar/edit/{id}/','SidebarController@sidebaredit')->middleware('auth');
Route::post('adminix/sidebar/edit/save','SidebarController@updatesidebar')->middleware('auth');
Route::get('adminix/sidebar/detail/{id}','SidebarController@detailside')->middleware('auth');


/** 
 * 
 * New Route maded
 * 
 */

 Route::get('/carilokasi', 'MapsController@index');
 Route::get('/carilokasi/request', 'MapsController@ajaxResponses');
 Route::get('/taglokasi', 'MapsController@tagLokasi')->middleware('auth')->name('inputlokasi');
 Route::post('/taglokasi', 'MapsController@saveLokasi')->middleware('auth')->name('savelokasi');
Route::get('/tutorial', 'IndexController@tutorial');
Route::get('/getprovince', 'DaerahController@province')->name('cariprovinsi');
Route::get('/getcity', 'DaerahController@city')->name('carikota');
Route::get('/getkecamatan', 'DaerahController@kecamatan')->name('carikecamatan');
