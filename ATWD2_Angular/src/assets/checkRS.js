function checkRS(){
    var RS = document.getElementById("resource").value;
    if(RS == "Routestopbus"){
        document.getElementById("Stop_Location").disabled = false;
        document.getElementById("Bus").disabled = true;
        document.getElementById("COMPANY").disabled = true;
        
    }
    if(RS == "Routebus"){
        document.getElementById("Stop_Location").disabled = true;
        document.getElementById("Bus").disabled = false;
        document.getElementById("COMPANY").disabled = false;
        
    }
    
}