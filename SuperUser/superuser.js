function getAllCheckUser() {
    var xhr=null;
    try{
        xhr=new XMLHttpRequest();
    }catch(e){
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("post","./getAllCheckUser.php",true);
    //set header
    xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
    //send data
    xhr.send();
    //action
    xhr.onreadystatechange=function(){
        if(xhr.readyState===4){
            if(xhr.status===200){
                let result = JSON.parse(xhr.responseText);
                // console.log(result);
                if (result.status === "success"){
                    console.log(result);
                    var tbody = document.getElementById("tbody");
                    var inner="";
                    for (var i=0; i<result.data.length; i++){
                        console.log(result.data[i]);
                        inner += "<tr><td>"+(i+1)+"</td><td>"+result.data[i].name+"</td><td>"
                            +result.data[i].role+"</td><td>"+result.data[i].email+
                            "</td><td><button class='chat' onclick='openDialog(\""+result.data[i].email+"\")'>Detail</button><button class='chat' onclick='disagree(\""+result.data[i].email+"\")'>Disagree</button></td></tr>"
                    }
                    tbody.innerHTML=inner;
                } else if (result.status === "fail"){
                    alert(result.reason);
                }


            }else{
                alert("error: "+xhr.status);
            }
        }
    };
}

function getRegisterInfo(email) {
    var xhr=null;
    var name = document.getElementById("name");
    var email_doc = document.getElementById("email");
    var age = document.getElementById("age");
    var gender = document.getElementById("gender");
    var telephone = document.getElementById("telephone");
    var role = document.getElementById("role");
    var info = document.getElementById("info");
    var attachment = document.getElementById('attachment');
    name.innerHTML = email_doc.innerHTML = age.innerHTML = gender.innerHTML = telephone.innerHTML = role.innerHTML = info.innerHTML = attachment.innerHTML = "";

    try{
        xhr=new XMLHttpRequest();
    }catch(e){
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("post","./getRegisterInfo.php",true);
    //set header
    xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
    //send data
    xhr.send("email="+email);
    //action
    xhr.onreadystatechange=function(){
        if(xhr.readyState===4){
            if(xhr.status===200){
                let result = JSON.parse(xhr.responseText);
                console.log(result);
                if (result.status === "success"){
                    console.log(result);

                    name.innerHTML = result.userInfo.data[0].name;
                    email_doc.innerHTML = result.userInfo.data[0].email;
                    age.innerHTML = result.userInfo.data[0].age;
                    gender.innerHTML = result.userInfo.data[0].gender;
                    telephone.innerHTML = result.userInfo.data[0].telephone;
                    role.innerHTML = result.userInfo.data[0].role;
                    if (result.userInfo.data[0].file_path) {
                        var img = document.createElement('img');//创建一个标签
                        img.setAttribute('src',result.userInfo.data[0].file_path);
                        img.style.width='400px';
                        document.getElementById('attachment').appendChild(img);//放到指定的id里
                    } else {
                        document.getElementById('attachment').innerHTML = "NULL";//放到指定的id里
                    }
                    if (result.registerInfo.length !== 0) {
                        if (result.userInfo.data[0].role === "subdivision"){
                            var info = "address: " + result.registerInfo.data[0].address;
                            document.getElementById('info').innerHTML=info;
                        }
                        if (result.userInfo.data[0].role === "building"){
                            var info = "subdivision: " + result.registerInfo.data[0].name + ", building number: " + result.registerInfo.data[0].building_number;
                            document.getElementById('info').innerHTML=info;
                        }
                        if (result.userInfo.data[0].role === "apartment"){
                            var info = "subdivision: " + result.registerInfo.data[0].name + ", building number: " +
                                result.registerInfo.data[0].building_number + ", apartment number: " + result.registerInfo.data[0].apartment_number;
                            document.getElementById('info').innerHTML=info;
                        }
                    }

                    // var name = document.getElementById("name");
                    // name.innerHTML = result.userInfo.data[0].name;
                    // var name = document.getElementById("name");
                    // name.innerHTML = result.userInfo.data[0].name;


                } else if (result.status === "fail"){
                    alert(result.reason);
                }


            }else{
                alert("error: "+xhr.status);
            }
        }
    };
}

function agree() {
    var email = document.getElementById("email").innerText;
    console.log(email);
    var xhr=null;
    try{
        xhr=new XMLHttpRequest();
    }catch(e){
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("post","./agreeRegister.php",true);
    //set header
    xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
    //send data
    xhr.send("email="+email);
    //action
    xhr.onreadystatechange=function(){
        if(xhr.readyState===4){
            if(xhr.status===200){
                let result = JSON.parse(xhr.responseText);
                console.log(result);
                if (result.status === "success"){
                    location.reload();
                } else if (result.status === "fail"){
                    alert(result.reason);
                }


            }else{
                alert("error: "+xhr.status);
            }
        }
    };
}

function disagree(email) {

    console.log(email);
    var xhr=null;
    try{
        xhr=new XMLHttpRequest();
    }catch(e){
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("post","./disagreeRegister.php",true);
    //set header
    xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
    //send data
    xhr.send("email="+email);
    //action
    xhr.onreadystatechange=function(){
        if(xhr.readyState===4){
            if(xhr.status===200){
                let result = JSON.parse(xhr.responseText);
                console.log(result);
                if (result.status === "success"){
                    // location.reload();
                } else if (result.status === "fail"){
                    alert(result.reason);
                }


            }else{
                alert("error: "+xhr.status);
            }
        }
    };
}

