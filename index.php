<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cool_PlayList - by César Gonçalves </title>
      <link href="assets/css/bootstrap.css" rel="stylesheet">
      <link href="assets/css/main.css" rel="stylesheet">
	  
      <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
	  
   </head>
   <body ng-app="usersApp" ng-controller="usersCTRL"> 
      <div class="navbar navbar-inverse navbar-static-top">
         <div class="container">
            <div class="navbar-header">
               <a class="navbar-brand" href="index.php">Cool PlayList</a>
            </div>
         </div>
      </div> 
      <div id="ww">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 col-lg-offset-2 centered">
                  <div class="col-lg-3">
                     <span class="glyphicon glyphicon-user"><h3>New User</h3></span>
                     
                  </div>
               </div> 
            </div>
            <div class="row mt">
               <div  class="col-lg-8 col-lg-offset-2">
                  <form  ng-submit="submitForm()"    role="form">
                     <div class="form-group">
                        <input type="name" ng-model="user.username" class="form-control" id="NameInputEmail1" placeholder="Your Username">
                        <br>
                     </div>
                     <div class="form-group">
                        <input type="email"  ng-model="user.email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        <br>
                     </div>
                     <button type="submit" class="btn btn-success">Add User</button>
                  </form>
               </div>
            </div> 
         </div> 
      </div> 
      <div   class="container pt">
         <div class="row mt">
            <table class="table">
               <thead>
                  <tr>
                     <th>User</th>
                     <th>Email</th>
                     <th>Edit Playlist</th>
                     <th>Remove user</th>
                  </tr>
               </thead>
               <tbody> 
			   <tr ng-repeat="x in names">
					<td>{{ x.user_name }}</td>
					<td>{{ x.user_email }}</td>
					<td>
						<button class="btn" ng-click="edit_playlist(x.user_id)">
						  <span class="glyphicon glyphicon-pencil"></span>
						</button>
					</td>
					<td>
						<button class="btn" ng-click="remove_user(x.user_id)">
						  <span class="glyphicon glyphicon-remove"></span>
						</button>
					</td>
				</tr>
               </tbody>
            </table>
         </div>
      </div>
      <div id="footer"> </div>
      </div>
      <script src="assets/js/bootstrap.min.js"></script>
	  <script>
		var app = angular.module('usersApp', []);
		//get the active users list
		app.controller('usersCTRL', function($scope, $http) {
			$http.get("api.php/users")
				.then(function(response) {
					$scope.names = response.data;
				});
				
			//deactivate user
			$scope.remove_user = function(id) {
				var json = '{"user_id":' + id + '}';
				$http({
						method: 'POST',
						url: 'api.php/deactivateUser',
						data: json,
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						}
					})
					.success(function(success) {
						//refresh the users list
						$http.get("api.php/users")
							.then(function(response) {
								$scope.names = response.data;
							});
					});
			}
			
			//show the playlist page referent to the selected user
			$scope.edit_playlist = function(id) {
				location.href = 'playlist.php?user_id=' + id;
			};

			//form submition to add new user
			$scope.user = {};
			$scope.submitForm = function() {

				$http({
						method: 'POST',
						url: 'api.php/addUser',
						data: $scope.user,
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						}
					})
					.success(function(success) {
						//refresh the users list
						$http.get("api.php/users")
							.then(function(response) {
								$scope.names = response.data;
							});
					});
			}
		});			
		 
	  </script>
   </body>
</html>