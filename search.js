$(document).ready(function(){
    $('#search').keyup(function(){
        var query = $(this).val();
            if(query !== ''){
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: { query: query },
                success: function(data){
                    var suggestions = data.split('\n');
                    var suggestionList = '';

                    if (suggestions.length > 0) {
                        suggestions.forEach(function(suggestion) {
                            suggestionList += '<div class="suggestion-item">' + suggestion + '</div>';
                        });
                    } else {
                        suggestionList = '<div class="no-suggestions">No suggestions found</div>';
                    }

                    $('#suggestion-box').html(suggestionList);
                }
            });
        } else {
            $('#suggestion-box').html('');
        }
    });
    $('#suggestion-box').on('click', '.suggestion-item', function(e) {
        e.stopPropagation(); 

        var selectedSuggestion = $(this).text();
        $('#search').val(selectedSuggestion);
        $('#suggestion-box').html(''); 
    });
    $(document).on('click', function(e) {
        var container = $('#suggestion-box');
        var searchInput = $('#search');

        if (!container.is(e.target) && container.has(e.target).length === 0 && !searchInput.is(e.target)) {
            container.html('');
        }
    });
});
