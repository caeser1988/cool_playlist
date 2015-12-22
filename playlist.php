<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
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
   <body ng-app="playlistApp">
      <div class="navbar navbar-inverse navbar-static-top">
         <div class="container">
            <div class="navbar-header">
               <a class="navbar-brand" href="index.php">Cool PlayList</a>
            </div>
         </div>
      </div>
      <div class="container pt"  ng-controller="trackCTRL">
         <button class="btn" ng-click="goto_users()" title="Go back to users">
         <a href="index.php"><span class="	glyphicon glyphicon-arrow-left"></span></a>
         </button>
         <div class="row">
            <div id="tracklist" class="col-lg-5">
               <h3>Music List</h3>
               <table class="table">
                  <thead>
                     <tr>
                        <th>Music</th>
                        <th>Album</th>
                        <th>Artist</th>
                        <th>Add to playlist</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr ng-repeat="x in trackName">
                        <td>{{ x.track_title }}</td>
                        <td>{{ x.album_title }}</td>
                        <td>{{ x.artist_name }}</td>
                        <td>
                           <button class="btn" ng-click="add_music(x.track_code)">
                           <span class="glyphicon glyphicon-plus"></span>
                           </button>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <button class="btn" ng-click="update_list()" title="Refresh list">
               <span class="update glyphicon glyphicon-retweet"></span>
               </button>
            </div>
            <div id="playlist" class="col-lg-6" >
               <h3 ng-repeat="user in userName">{{user.user_name}} Playlist</h3>
               <table class="table">
                  <thead>
                     <tr>
                        <th>Music</th>
                        <th>Album</th>
                        <th>Artist</th>
                        <th>Remove from playlist</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr ng-repeat="y in playlistTracks">
                        <td>{{ y.track_title }}</td>
                        <td>{{ y.album_title }}</td>
                        <td>{{ y.artist_name }}</td>
                        <td>
                           <button class="btn" ng-click="remove_music(y.track_code)">
                           <span class="glyphicon glyphicon-remove"></span>
                           </button>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div id="footer"> </div>
      <script src="assets/js/bootstrap.min.js"></script>
      <script>
		 function getparameter(param) {


			var get = [];
			location.search.replace('?', '').split('&').forEach(function(val) {
				split = val.split("=", 2);
				get[split[0]] = split[1];
			});
			return get[param];

		}
		var app = angular.module('playlistApp', []);
		
		//show the list of active tracks to add to a  playlist
		app.controller('trackCTRL', function($scope, $http) {
			$http.get("api.php/tracks")
				.then(function(response) {
					$scope.trackName = response.data;
				});
				
			//get the username based on user_id	
			var userid = getparameter('user_id');
			var json = '{"user_id":' + userid + '}';
			$http({
					method: 'POST',
					url: 'api.php/username',
					data: json,
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					}
				})
				.success(function(response) {
					$scope.userName = response;
				});

			//add music to user playplist
			$scope.add_music = function(id) {
				var userid = getparameter('user_id');
				var json = '{"user_id":' + userid + ',"music_id":' + id + '}';
				$http({
						method: 'POST',
						url: 'api.php/addMusic',
						data: json,
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						}
					})
					.success(function(data) {
						var userid = getparameter('user_id');
						var json = '{"user_id":' + userid + '}';
						$http({
								method: 'POST',
								url: 'api.php/playlist',
								data: json,
								headers: {
									'Content-Type': 'application/x-www-form-urlencoded'
								}
							})
							.success(function(response) {
								//refresh the playlist 
								$scope.playlistTracks = response;
							});
					});
			};
			//update track list based on external link
			$scope.update_list = function() {
				$.getJSON("http://freemusicarchive.org/recent.json", function(json) {

					var jsonresp = json.aTracks;
					for (var i = 0; i < jsonresp.length; i++) {
						$http({
								method: 'POST',
								url: 'api.php/updatetracks',
								data: jsonresp[i],
								headers: {
									'Content-Type': 'application/x-www-form-urlencoded'
								}
							})
							.success(function(success) {
								$http.get("api.php/tracks")
									.then(function(response) {
										//refresh the track list 
										$scope.trackName = response.data;
									});
							});
					}
				});
			}

			//get the playlist from the user
			var userid = getparameter('user_id');
			var json = '{"user_id":' + userid + '}';
			$http({
					method: 'POST',
					url: 'api.php/playlist',
					data: json,
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					}
				})
				.success(function(response) {
					//refresh the playlist 
					$scope.playlistTracks = response;
				});

			//remove music from playlist
			$scope.remove_music = function(id) {
				var userid = getparameter('user_id');
				var json = '{"user_id":' + userid + ',"music_id":' + id + '}';
				$http({
						method: 'POST',
						url: 'api.php/removeMusic',
						data: json,
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded'
						}
					})
					.success(function(data) {
						var json = '{"user_id":' + userid + '}';
						$http({
								method: 'POST',
								url: 'api.php/playlist',
								data: json,
								headers: {
									'Content-Type': 'application/x-www-form-urlencoded'
								}
							})
							.success(function(response) {
								//refresh the playlist 
								$scope.playlistTracks = response;
							});
					});
			};
		});
		 
      </script>
   </body>
</html>