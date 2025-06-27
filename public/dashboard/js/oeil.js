
    e=true;
    function changer()
    {
        if(e)
        {
            document.getElementById("password").setAttribute("type","text");
            document.getElementById("eye").src="/Auth/oeil/oeilv.png";
            e=false;
        }
        else
        {
            document.getElementById("password").setAttribute("type","password");
            document.getElementById("eye").src="/Auth/oeil/oeilc.png";
            e=true;
        }
    }
