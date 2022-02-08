$(document).ready(function(){

    // handle 'read exercices' button click
    $(document).on('click', '.read-exercices-button', function(){
        
        // get day id
        var id = $(this).attr('data-id');

        // read day record based on given ID
        $.getJSON("http://localhost/api/track_rest_api/api/exrs_info/read__.php?id=" + id, function(data){
            // start html
            var read_exercices_html=`
            
            <h2>Exercices</h2>
            <!-- Exercices will be shown in this table -->
            <table class='table table-bordered table-hover'>

                <tr>
                    <td>Exercice</td>
                    <td>Reps</td>
                    <td>Sets</td>
                    <td>Weight</td>
                </tr>`;

            // loop through returned list of data
            $.each(data.records, function(key, val_) {

                // creating new table row per record
                read_exercices_html+=`
                    <tr>
                        <td>` + val_.name + `</td>
                `;

                // loop through returned list of data
                $.each(data.records, function(key, val) {

                    // creating new table row per record
                    read_exercices_html+=`
                        <td>` + val.reps + `</td>
                        <td>` + val.sets + `</td>
                        <td>` + val.weight + `</td>`;

                });

                read_exercices_html+=`</tr>`;

            });

            read_exercices_html+=`</table>`;

            // inject html to 'page-content' of our app
            $("#page-content").append(read_exercices_html);
        });
        });
    });