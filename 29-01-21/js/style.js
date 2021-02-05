/* Theme Change & Cookies Code */

    function selectTheme(){
        var val = getCookie("themeMode");
        if(val == "dark")
        document.getElementById("dropdownbtn").selectedIndex = 1;
        else
        document.getElementById("dropdownbtn").selectedIndex = 0;
        changeTheme(val);
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    function createCookie(name, value) {
        var expires;
        var date = new Date();
        date.setTime(date.getTime() +( 24 * 60 * 60 * 30000));
        expires = "; expires=" + date.toGMTString();
        document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
    }


function changeTheme(val)
{
    createCookie("themeMode", val);
    head = document.getElementById("head");
    brand = document.getElementById("brand");
    about = document.getElementsByClassName("about");
    gallery = document.getElementById("gallery");
    users = document.getElementById("users");
    usersCard =  document.getElementsByClassName("usersCard");
    usersTable =  document.getElementsByClassName("usersTable");
    usersTableHead =  document.getElementsByClassName("usersTable-head");
    usersTableBody =  document.getElementsByClassName("usersTable-body");
    contact =  document.getElementsByClassName("contact");
    contactBody =  document.getElementsByClassName("contact-body");
    footer =  document.getElementsByClassName("footer");
    btnTheme =  document.getElementsByClassName("btnTheme");
    if(val=="dark"){
        head.className = "navbar navbar-expand-lg navbar-dark bg-dark fixed-top";
        brand.className = "navbar-brand text-light";
        for (i = 0; i < about.length; i++) {
            about[i].style.backgroundColor = "#30475e";
            about[i].style.color = "#ececec";
        }
        gallery.style.backgroundColor = "#222831";
        gallery.style.color = "#ececec";
        users.className = "container-fluid p-5 w-100 text-light";
        users.style.backgroundColor = "#30475e";
        for (i = 0; i < usersCard.length; i++) {
            usersCard[i].className = "card rounded usersCard bg-dark";
        }
        usersTable[0].className = "table table-hover table-dark text-light usersTable";
        usersTableHead.className = "thead-dark text-light";
        usersTableBody.className = "bg-dark text-light";
        contact[0].style.backgroundColor = "#222831";
        contact[0].className = "container-fluid contact p-3 text-light";
        footer[0].className = "container-fluid text-light m-0 footer";
        footer[0].style.backgroundColor = "#30475e";
        btnTheme[0].className = "btn btn-secondary dropdown-toggle btnTheme";
    }
    else{

        head.className = "navbar navbar-expand-lg navbar-light bg-light fixed-top";
        brand.className = "navbar-brand text-dark";
        for (i = 0; i < about.length; i++) {
            about[i].style.backgroundColor = "";
            about[i].style.color = "";
        }
        gallery.style.backgroundColor = "";
        gallery.style.color = "";
        users.className = "container-fluid p-5 w-100 bg-info";
        users.style.backgroundColor = "";
        for (i = 0; i < usersCard.length; i++) {
            usersCard[i].className = "card rounded usersCard bg-light";
        }
        usersTable[0].className = "table table-hover table-light text-dark usersTable";
        usersTableHead.className = "thead-dark text-light";
        usersTableBody.className = "bg-light text-dark";
        contact[0].style.backgroundColor = "";
        contact[0].className = "container-fluid contact p-3 text-dark";
        footer[0].className = "container-fluid bg-secondary text-light m-0 footer";
        footer[0].style.backgroundColor = "";
        btnTheme[0].className = "btn btn-light dropdown-toggle btnTheme";
    }
}