$(document).ready(function(){
    $('#searchBtn').click(function(){
        var query = $('#search').val().trim();
        
        if(query !== ''){
            $.ajax({
                url: 'idFromName.php',
                method: 'POST',
                data: { name: query },
                success: function(id){
                    if(id !== "ID not found"){
                        window.location.href = 'admin_profile.php?user_id=' + id;
                    } else {
                        
                        alert("ID not found for the entered name");
                    }
                }
            });
        } else {
         
            alert("Please enter a name to search");
        }
    });
});