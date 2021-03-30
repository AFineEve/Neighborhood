//用于判断用户当前是否登录，若登录则更新sessionStorage信息，若没有返回登陆页面
var xhr=null;
try{
    xhr=new XMLHttpRequest();
}catch(e){
    xhr=new ActiveXObject("Microsoft.XMLHTTP");
}
//post
xhr.open("post","../php_public/login_status.php",true);
//set header
xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
//send data
xhr.send();
//action
xhr.onreadystatechange=function(){
    if(xhr.readyState===4){
        if(xhr.status===200){
            let result = JSON.parse(xhr.responseText);
            if (result.status === "success"){
                //update user info in sessionStorage
                sessionStorage.setItem("user_info", xhr.responseText);
            } else if (result.status === "fail"){
                alert("You Need Login!");
                window.location.href = "../Login/login.html";
            }


        }else{
            alert("错误"+xhr.status);
        }
    }
}

