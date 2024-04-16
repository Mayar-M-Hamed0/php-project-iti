<?php

class Review extends Database{


public function addreview($uid,$cid,$ratting,$comment){
    $sql="  INSERT INTO reviews (user_id,course_id,rating,comment) VALUES ($uid,$cid,$ratting,'$comment')";
    $stmt=$this->conn->execute_query( $sql);
    return $stmt;
}

public function updatereview($ratting,$comment,$rid){
    $sql="UPDATE reviews set rating='$ratting' , comment='$comment' where review_id=$rid ";
    $stmt=$this->conn->execute_query( $sql);
    return $stmt;
}


public function showereview($cid){
    $sql="SELECT r.review_id, r.rating ,r.comment, p.profile_img ,u.username,r.user_id
    from users u,profiles p , reviews r
    where r.user_id=u.user_id and u.user_id=p.user_id and r.course_id=$cid;";
    $stmt=$this->conn->execute_query( $sql);
    $result=$stmt->fetch_all(MYSQLI_ASSOC);
    return $result;
}
public function getsingle($rid){
    $sql="SELECT r.course_id, r.rating ,r.comment, p.profile_img ,u.username,r.user_id
    from users u,profiles p , reviews r
    where r.user_id=u.user_id and u.user_id=p.user_id and r.review_id=$rid;";
    $stmt=$this->conn->execute_query( $sql);
    $result=$stmt->fetch_all(MYSQLI_ASSOC);
    return $result;
}




public function delet($rid){
    $sql=" DELETE FROM reviews WHERE review_id=$rid;";
    $stmt=$this->conn->execute_query( $sql);
    return $stmt;
   
}




}