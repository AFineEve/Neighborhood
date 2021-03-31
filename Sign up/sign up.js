function verify() {
    var email = document.getElementById("email").value;
    console.log(email);
    var xhr=null;
    try{
        xhr=new XMLHttpRequest();
    }catch(e){
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    //post
    xhr.open("post","./verify.php",true);
    //set header
    xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
    //send data
    xhr.send("email="+email);
    //action
    xhr.onreadystatechange=function(){
        if(xhr.readyState===4){
            if(xhr.status===200){
                let result = JSON.parse(xhr.responseText);
                if (result.status === "success"){
                    alert("Verification code has been send!");
                    console.log(result.verification);
                    sessionStorage.setItem("verification", result.verification);
                } else if (result.status === "fail"){
                    alert("Failed! Reason is "+result.reason);
                }


            }else{
                alert("错误"+xhr.status);
            }
        }
    };
}