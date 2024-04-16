<?php
include_once("../classes/profile-info.php");
class ProfileInfoContr extends ProfileInfo{
        private $userid;
        private $username;

        public function getinfo($userid){
            $this->userid=$userid;
        }



        public function defaultcreation(){
            $profileAbout="Tell people apout yourself ,Interst, hoppies or your favourite TV show";
            $profileIntrotext="Welcome to myprofile page soon i'll tell you about my self and what you can find here";
            $profileImg="cool-profile-picture-1ecoo30f26bkr14o.jpg";
            $this->CreateProfileInfo($profileAbout,$profileIntrotext,$profileImg,$this->userid);
        }




        public function updateProfile($profile_about, $profile_introtext, $profile_img){
            if ($this->checkempty($profile_about, $profile_introtext)==true){
                header("location:../view/profilesettings.php?error=emptyfield");
                exit();
            }
        
        
            else{
                $this->updateProfileInfowithimg($profile_about, $profile_introtext, $profile_img, $this->userid);
            }

        }                    
        public function updateProfilenoimg($profile_about, $profile_introtext){
            $this->updateProfileInfo($profile_about, $profile_introtext,  $this->userid);

        }                    



        private function checkempty($profile_about, $profile_introtext){
              
            
            if(empty($profile_about)|| empty($profile_introtext)) {
                $result=true;
            }
            else {
                $result=false;
            }

            return $result;

        }
        private function checkimg($profile_img){
              
            
            if( empty($profile_img)) {
                $result=true;
            }
            else {
                $result=false;
            }

            return $result;

        }



    


}