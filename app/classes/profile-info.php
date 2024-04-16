<?php
include_once("Dbconnect.php");
class ProfileInfo extends Database
{
    public function getProfileInfo($userId)
    {
        $mysql = "SELECT * FROM profiles WHERE user_id = $userId";
        $stmt = $this->conn->execute_query($mysql);
        if (!$stmt) {
            $stmt = null;
            header("location:profile.php?error=stmtFailed");
            exit();
        }
        if ($stmt->num_rows == 0) {
            $stmt = null;
            header("location:profile.php?error=noProfilePage");
            exit();
        }
        $result = $stmt->fetch_assoc();
        return $result;
    }

    public function getusername($id){
        $mysql = "SELECT * FROM users WHERE user_id = $id";
        $stmt = $this->conn->execute_query($mysql);
        $result=$stmt->fetch_assoc();
        return $result;
    }




    protected function updateProfileInfowithimg($profile_about, $profile_introtext, $profile_img , $user_id)
    {
        $sql = "UPDATE profiles SET profile_about=? ,profile_introtext=?, profile_img =? WHERE user_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["$profile_about", "$profile_introtext", "$profile_img", $user_id]);
        if (!$stmt) {
            $stmt = null;
            header("location:profile.php?error=stmtFailed");
            exit();
        }
        
        $stmt = null;
    }
    protected function updateProfileInfo($profile_about, $profile_introtext, $user_id)
    {
        $sql = "UPDATE profiles SET profile_about=? ,profile_introtext=? WHERE user_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["$profile_about", "$profile_introtext", $user_id]);
        if (!$stmt) {
            $stmt = null;
            header("location:profile.php?error=stmtFailed");
            exit();
        }
        
        $stmt = null;
    }



    protected function CreateProfileInfo($profile_about, $profile_introtext, $profile_img, $user_id)
    {
        $sql = "INSERT INTO profiles  (profile_about ,profile_introtext, profile_img,user_id ) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$profile_about, $profile_introtext, $profile_img, $user_id]);
        if (!$stmt) {
            $stmt = null;
            header("location:profile.php?error=stmtFailed");
            exit();
        }
      
       
        $stmt = null;
    }
}
