<?php 
	require_once("Rest.inc.php"); 
	
	class API extends REST {
	
		public $data = "";
		 
		private $db = NULL;
	
		public function __construct(){
			parent::__construct();				
		}
		
		/*
		 * Public method for access api.
		 * This method dynmically call the method based on the query string
		 *
		 */
		public function processApi(){
			$piece = explode("/", $_SERVER['REQUEST_URI']); 
			$func = end($piece);
			if((int)method_exists($this,$func) > 0){
				$con = mysqli_connect("localhost","root","","playlist"); 
				// Check connection
				if (mysqli_connect_errno()){
				  echo "Failed to connect to MySQL: " . mysqli_connect_error();
				 }
					
				$this->$func($con); 
			}else
				$this->response('',404);// If the method not exist with in this class, response would be "Page not found".
		}
		
		 
		/*
		 *
		 * This method get the users list in active state based on the query string
		 *
		 */
		private function users($conn){	 
			$query = 'SELECT user_id, user_name, user_email FROM users WHERE user_status = 0';
			$sql = $conn->query($query);
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					 $result[] = $rlt;  
				}
				$this->response($this->json($result), 200); 
			}
			$this->response('',204);	// If no records "No Content" status
		}
		
		/*
		 *
		 * This method get the username of the user
		 *
		 */
		private function username($conn){	
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
			$user_id = $request->user_id;
			$query = 'SELECT user_name FROM users WHERE user_id ='.$user_id;
			$sql = $conn->query($query);
			if($sql->num_rows > 0){
				$result = array();
				while($rlt = $sql->fetch_assoc()){
					 $result[] = $rlt;  
				}
				$this->response($this->json($result), 200); 
			}
			$this->response('',204);	// If no records "No Content" status
		}

		/*
		 *
		 * This method get the playlist with the selected tracks for each user 
		 *
		 */
		private function playlist($conn){	
			$tracks_arr = array();
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
			$user_id = $request->user_id;
			
			$query = 'SELECT playlist_id FROM playlist WHERE user_id = '.$user_id;
			$sql = $conn->query($query);
			if($sql->num_rows > 0){
				$result = $sql->fetch_assoc();
				$query2 = 'SELECT track_id FROM rel_playlist_tracks WHERE playlist_id = '.$result['playlist_id'].' and rel_playlist_tracks_status = 0';
				$sql2 = $conn->query($query2); 
				while($rlt = $sql2->fetch_assoc()){
					$query3 = 'SELECT track_code, track_title, album_title, artist_name FROM tracks WHERE track_id = '.$rlt['track_id'].' and track_status = 0';
					$sql3 = $conn->query($query3);
					while($tracks_list = $sql3->fetch_assoc()){
						$tracks_arr[] = $tracks_list;
					}  
				}
				$this->response($this->json($tracks_arr), 200); 
			}
			$this->response('',204);
		}

		/*
		 *
		 * This method get the list of tracks available for selection
		 *
		 */
		private function tracks($conn){
			$tracks_arr = array(); 
			$query = 'SELECT track_code, track_title, album_title, artist_name FROM tracks WHERE track_status = 0';
			$sql = $conn->query($query); 
			while($tracks_list = $sql->fetch_assoc()){
				$tracks_arr[] = $tracks_list;
			} 
			$this->response($this->json($tracks_arr), 200); 
		}

		/*
		 *
		 * This method add a new user
		 *
		 */
		private function addUser($conn){	
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
			@$user_email = $request->email;
			@$user_name = $request->username;
			
			$query = 'INSERT INTO `users`(`user_name`, `user_email`, `user_status`) VALUES ("'.$user_name.'", "'.$user_email.'",0)';
			$sql = $conn->query($query); 
		
			$query2 = "SELECT MAX(user_id) as user_id FROM users";
			$sql2 = $conn->query($query2);
			if($sql2->num_rows > 0){
				$result =  $sql2->fetch_assoc();
				$query3 = 'INSERT INTO `playlist`(`user_id`, `playlist_status`) VALUES ('.$result['user_id'].', 0)';
				$sql3 = $conn->query($query3);
				
				$query4 = 'SELECT playlist_id FROM playlist where user_id = '.$result['user_id'];
				$sql4 =  $conn->query($query4);
				if($sql4->num_rows > 0){
					$this->response('',200);
				}
			}
			$this->response('',204);
		}

		/*
		 *
		 * This method add a new track to a playlist based on user id
		 *
		 */
		private function addMusic($conn){	
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
			$user_id = $request->user_id;
			$track_code =  $request->music_id;
			$query_track = 'SELECT track_id FROM tracks where track_code ='.$track_code;
			$sql_track =  $conn->query($query_track);
			$result_track = $sql_track->fetch_assoc();
			$track_id = $result_track['track_id'];
			$query = 'SELECT playlist_id FROM playlist where user_id ='.$user_id;
			$sql =  $conn->query($query);
			if($sql->num_rows > 0){
				$result = $sql->fetch_assoc();
				$query_teste = 'select * from rel_playlist_tracks where playlist_id = '.$result['playlist_id'].' and track_id= '.$track_id.' and rel_playlist_tracks_status=0'; 
				
				$sql_teste =  $conn->query($query_teste);
				if($sql_teste->num_rows == 0){
					$query2 = 'INSERT INTO `rel_playlist_tracks`(`playlist_id`, `track_id`, `rel_playlist_tracks_status` ) VALUES ('.$result['playlist_id'].', '.$track_id.', 0)';
					$sql2 = $conn->query($query2);
					$query3 = 'SELECT rel_playlist_tracks_id FROM rel_playlist_tracks where playlist_id = '.$result['playlist_id'].' and track_id = '.$track_id;
					$sql3 = $conn->query($query3);
					if($sql3->num_rows > 0){
						$this->response('',200);
					}  
				} 
			}
			$this->response('',204); 
		}

		/*
		 *
		 * This method remove a track from a playlist set status = 1
		 *
		 */
		private function removeMusic($conn){
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
			$user_id = $request->user_id;
			$track_code =  $request->music_id;
			 
				$query = 'SELECT playlist_id FROM playlist where user_id = '.$user_id;
				$sql = $conn->query($query);
					if($sql->num_rows > 0){
						$result = $sql->fetch_assoc();
						$query_track = 'SELECT track_id FROM tracks where track_code ='.$track_code;
						$sql_track =  $conn->query($query_track);
						$result_track = $sql_track->fetch_assoc();
						$track_id = $result_track['track_id'];
						$query2 = 'SELECT rel_playlist_tracks_id FROM rel_playlist_tracks where track_id= '.$track_id.' and playlist_id = '.$result['playlist_id'] ;
						$sql2 = $conn->query($query2);
						if($sql2->num_rows > 0){
							$query3 = 'Update rel_playlist_tracks set rel_playlist_tracks_status = 1 WHERE track_id = '.$track_id.' and playlist_id = '.$result['playlist_id'];
							$sql3 = $conn->query($query3); 
							$this->response('',200); 
						} 
				
			}else
				$this->response('',204);
		}
		/*
		 *
		 * This method remove a user and playlist from list set status = 1
		 *
		 */
		private function deactivateUser($conn){
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
			$user_id = $request->user_id; 
			if($user_id > 0){
				$query = 'Update users set user_status = 1 WHERE user_id = '.$user_id;			
				$sql = $conn->query($query); 
				$query2 = 'SELECT playlist_id FROM playlist where user_id = '.$user_id;
				$sql2 = $conn->query($query2);
				if($sql2->num_rows > 0){
					$result = $sql2->fetch_assoc();
					$query3 = 'Update playlist set playlist_status = 1 WHERE playlist_id = '.$result['playlist_id'];			
					$sql3 = $conn->query($query3);
					$query4 = 'Update rel_playlist_tracks set rel_playlist_tracks_status = 1 WHERE  playlist_id = '.$result['playlist_id'];
					$sql4 = $conn->query($query4); 
					$this->response('',200);							
				}
				$this->response('',204);
				
			}else
				$this->response('',204); 
		}	
		
		/*
		 *
		 * This method update track list based on external json
		 * This method dont remove the existent tracks just add the new tracks based on track_code a unique key present on the external json as trackid
		 *
		 */
		private function updatetracks($conn){
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata); 
			$track_code= $request->track_id;
			$track_title= $request->track_title;
			$track_image_file= $request->track_image_file;
			$track_bit_rate= $request->track_bit_rate;
			$track_copyright_c= $request->track_copyright_c;
			$track_composer= $request->track_composer;
			$track_lyricist= $request->track_lyricist;
			$track_publisher= $request->track_publisher;
			$track_information= $request->track_information;
			$track_status_encoding= $request->track_status_encoding;
			$track_date_recorded= $request->track_date_recorded;
			$track_date_created= $request->track_date_created;
			$track_date_published= $request->track_date_published;
			$artist_name= $request->artist_name;
			$album_title= $request->album_title;
			$license_id= $request->license_id;
			$license_parent_id= $request->license_parent_id;
			$license_title= $request->license_title;
			$license_url= $request->license_url;
			 
			$query = 'select * from tracks where track_code='.$track_code.' and track_status = 0';  
			$sql = $conn->query($query);
			
				 if($sql->num_rows == 0){
					$query2 = 'INSERT INTO `tracks`( `track_title`, `track_image_file`, `track_bit_rate`, `track_copyright_c`, `track_composer`, `track_lyricist`, `track_publisher`, `track_information`, `track_status_encoding`, `track_date_recorded`, `track_date_created`, `track_date_published`, `artist_name`, `album_title`, `license_id`, `license_parent_id`, `license_title`, `license_url`, `track_code`, `track_status`) VALUES ( "'.$track_title.'", "'.$track_image_file.'", "'.$track_bit_rate.'", "'.$track_copyright_c.'", "'.$track_composer.'", "'.$track_lyricist.'", "'.$track_publisher.'", "'.$track_information.'", "'.$track_status_encoding.'", "'.$track_date_recorded.'", "'.$track_date_created.'", "'.$track_date_published.'", "'.$artist_name.'", "'.$album_title.'", "'.$license_id.'", "'.$license_parent_id.'", "'.$license_title.'", "'.$license_url.'", "'.$track_code.'", 0)';
					$conn->query($query2);
					$this->response('',200);
				}
			$this->response('',204); 
		} 
				
		/*
		 *	Encode array into JSON
		*/
		private function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}
	}
	
	// Initiiate Librar	
	$api = new API; 
	$api->processApi();
?>