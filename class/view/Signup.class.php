<?php


class Signup extends Page 
{
    public $doc;
    
    public function __construct()
    {
        $this->doc .= '';
        
    
    function formSignUp()
    {
        $this->doc.='<form class="signUp" action="signUP.php" method="POST" >
            <input type="text" name="first" placeholder="Firstname">
            <input type="text" name="last" placeholder="Lastname">
            <input type="text" name="email" placeholder="E-mail">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="password">
            <button type="submit" name="submit">Sign up</button>
            <input name= "f_id" type="hidden" value="signup">
            </form>';
        
        
        
    }
    function signUpCheck()
    {
        
        
    }
}