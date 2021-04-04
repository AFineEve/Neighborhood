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
                alert("error: "+xhr.status);
            }
        }
    };
}


function register() {
    if (document.getElementById("password").value != document.getElementById("c_password").value) {
        alert("The Confirm Password Does Not Match Password!");
        return;
    }
    if (document.getElementById("verification_code").value != sessionStorage.getItem("verification")) {
        alert("The Verification Code Is Wrong!");
        return;
    }
    var form = document.getElementById("register_form");
    form.submit();
    // var form = new FormData();
    // form.append("subdivision_name", document.getElementById("subdivision_name").value);
    // form.append("subdivision_address", document.getElementById("subdivision_address").value);
    // form.append("name", document.getElementById("name").value);
    // form.append("password", document.getElementById("password").value);
    // form.append("age", document.getElementById("age").value);
    // form.append("gender", document.getElementById("gender").value);
    // form.append("email", document.getElementById("email").value);
    // form.append("telephone", document.getElementById("telephone").value);
    // form.append("attachment", document.getElementById("attachment").files[0]);
    // ajax("post", form, "./register.php")
    // form.append("name", document.getElementById("name").value);
    // console.log(form.entries().next());




}

function checkName() {
    var subdivision_name = document.getElementById("subdivision_name").value;
    var xhr=null;
    try{
        xhr=new XMLHttpRequest();
    }catch(e){
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    //post
    xhr.open("post","./check.php",true);
    //set header
    xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
    //send data
    xhr.send("subdivision_name="+subdivision_name);
    //action
    xhr.onreadystatechange=function(){
        if(xhr.readyState===4){
            if(xhr.status===200){
                let result = JSON.parse(xhr.responseText);
                if (result.status === "success"){
                    console.log(result.verification);
                } else if (result.status === "fail"){
                    alert("Failed! Reason is "+result.reason);
                }


            }else{
                alert("error: "+xhr.status);
            }
        }
    };
}

function getInfo(type) {
    var xhr=null;
    try{
        xhr=new XMLHttpRequest();
    }catch(e){
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    //post
    xhr.open("post","./getInfo.php",true);
    //set header
    xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
    //send data
    xhr.send("type="+type);
    //action
    xhr.onreadystatechange=function(){
        if(xhr.readyState===4){
            if(xhr.status===200){
                let result = JSON.parse(xhr.responseText);
                if (result.status === "success"){
                    console.log(result);
                    var subdivision_name = document.getElementById("subdivision_name");
                    subdivision_name.options.add(new Option("", ""));
                    for (var i = 0; i < result.subdivision.data.length; i++) {
                        subdivision_name.options.add(new Option(result.subdivision.data[i].name, result.subdivision.data[i].id));
                    }

                } else if (result.status === "fail"){
                    alert("Failed! Reason is "+result.reason);
                }


            }else{
                alert("error: "+xhr.status);
            }
        }
    };
}

function getBuilding() {
    var subdivision_name = document.getElementById("subdivision_name").value;
    var xhr=null;
    try{
        xhr=new XMLHttpRequest();
    }catch(e){
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }

    // xhr.open("post","./getInfo.php",true);
    //post
    xhr.open("post","./getBuilding.php",true);
    //set header
    xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
    //send data
    xhr.send("subdivision_name="+subdivision_name);
    //action
    xhr.onreadystatechange=function(){
        if(xhr.readyState===4){
            if(xhr.status===200){
                let result = JSON.parse(xhr.responseText);
                // console.log(result);
                if (result.status === "success"){
                    console.log(result);
                    var building_number = document.getElementById("building_number");
                    for (var i = 0; i < result.building.data.length; i++) {
                        building_number.options.add(new Option(result.building.data[i].building_number, result.building.data[i].building_number));
                    }
                } else if (result.status === "fail"){
                    alert(result.reason);
                }


            }else{
                alert("error: "+xhr.status);
            }
        }
    };
}

function ajax(type, data, url) {
    var xhr=null;
    try{
        xhr=new XMLHttpRequest();
    }catch(e){
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }

    // xhr.open("post","./getInfo.php",true);
    //post
    xhr.open(type,url,true);
    //set header
    xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
    //send data
    xhr.send(data);
    //action
    xhr.onreadystatechange=function(){
        if(xhr.readyState===4){
            if(xhr.status===200){
                let result = JSON.parse(xhr.responseText);
                // console.log(result);
                if (result.status === "success"){
                    console.log(result);
                } else if (result.status === "fail"){
                    alert(result.reason);
                }


            }else{
                alert("error: "+xhr.status);
            }
        }
    };

}