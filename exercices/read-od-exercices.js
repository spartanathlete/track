$(document).ready(function(){
    // handle 'read exercices' button click
    $(document).on('click', '.read-exercices-button', function(){
        // get day id
        var date = $(this).attr('data-date');

        // read day record based on given ID
        $.getJSON("http://localhost/api/track_rest_api/api/exercices/read_.php?date=" + date, function(data){
            // start html
            var read_exercices_html=`
            
                <h2>Exercices</h2>
                <!-- Exercices will be shown in this table -->
                <table class='table table-bordered table-hover'>

                    <tr>
                        <td>Name</td>
                    </tr>`;

            // loop through returned list of data
            $.each(data.records, function(key, val) {
            
                // creating new table row per record
                read_exercices_html+=`
                    <tr>` + val.name + `</tr>`;
            });

            read_exercices_html+=`</table>`;

            // inject html to 'page-content' of our app
            $("#page-content").html(read_exercices_html);
        });
    });
});