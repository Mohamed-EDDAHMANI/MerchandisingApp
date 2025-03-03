<?php

$router->get('/','UserController@gethomePage');
// ---- on the get home page (Page with Auth)
// $router->get('/home/listAnnonce','UserController@getAllAnnonce');
$router->get('/detailsAnnonce','UserController@detailsAnnonce');
$router->get('/reservation','UserController@getReservationPage');
$router->get('/reservation/reserver','UserController@reserver');
$router->get('/myReservations','UserController@myReservations');
$router->get('/myReservations/delete/{id}','UserController@reservationsDelete');
$router->get('/checkout','UserController@getpayementPage');
$router->get('/success','UserController@getSuccessPage');
$router->get('/cancel','UserController@getCancelPage');
$router->get('/pageAnnonces','UserController@getAllAnnoncePage');
$router->get('/conversation','UserController@getConversationPage');
$router->get('/myHistoriques','UserController@getHistoriquePage');
$router->get('/payementPage/payer','UserController@effectuerPayement');

//sans auth
$router->get('/index','UserController@getIndexPage');
// ---- on the get index page (Page without Auth)
// $router->get('/index/listAnnonce','UserController@listAnnonce');
$router->get('/index/getAllAnnonce','UserController@getAllAnnonce');
$router->get('/index/getTopAnnonce','UserController@getTopAnnonce');
$router->post('/index/getTopCommentaire','UserController@getTopCommentaire');

$router->get('/admin', 'AdminController@Dashboard');
$router->get('/admin/proprelated/users', 'AdminController@getAllUsers');
$router->post('/admin/toggleUserStatus', 'AdminController@toggleUserStatus');
$router->post('/admin/deleteUser', 'AdminController@DeleteUser');
$router->post('/admin/restoreUser', 'AdminController@restoreUser');
$router->post('/admin/permanentDeleteUser', 'AdminController@permanentDeleteUser');
$router->get('/admin/proprelated/annonces', 'AdminController@getAllAnnonces');
$router->post('/admin/toggleAnnoncesStatus', 'AdminController@toggleUserStatus');
$router->post('/admin/deleteAnnonces', 'AdminController@deleteAnnonce');
$router->post('/admin/restoreAnnonces', 'AdminController@restoreUser');
$router->post('/admin/permanentDeleteAnnonces', 'AdminController@permanentDeleteUser');
$router->get('/admin/proprelated/populaire_propritaire', 'AdminController@getPopulairePropritaire');
$router->get('/admin/proprelated/revenus', 'AdminController@getRevenux');
$router->post('/admin/deleteCommentaires/{id}', 'AdminController@deleteCommentaires');
$router->post('/admin/gestionLitige', 'AdminController@gestionLitige');

$router->get('/proprietaire','proprietaireController@proprietaireDashboard');
$router->get('/myAnnonces','proprietaireController@getMyAnnonces');
$router->get('/getAnnonceByid/{id}','proprietaireController@getAnnonceByid');
$router->get('/getReservations','proprietaireController@getReservations');
$router->post('/createAnnonce', 'proprietaireController@createAnnonce');
$router->post('/deleteAnnonce/{id}', 'proprietaireController@deleteAnnonce');
$router->post('/UpdateAnnonce/{id}', 'proprietaireController@UpdateAnnonce');

$router->get('/login', 'AuthController@getLoginPage');
$router->post('/login', 'AuthController@login');

$router->get('/singUp', 'AuthController@getSingUpPage');
$router->post('/singUp', 'AuthController@singUp');
$router->get('/login/google', 'AuthController@authGoogle');
$router->post('/singUp/google/form', 'AuthController@singUpGoogle');