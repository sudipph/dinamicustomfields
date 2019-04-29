
//}
function download_data_file(pid) {
    console.log('sss');
    document.location.href = ajax_url + '?action=download_from_ajax_dynamic&pid=' + pid;
    // download_from_ajax_dynamic
    // $.ajax({
    //     url: ajax_url,
    //     method: 'GET',
    //     data: {
    //         action: "download_from_ajax_dynamic"
    //     },
    //     xhrFields: {
    //         responseType: 'blob'
    //     },
    //     success: function (data) {
    //         var a = document.createElement('a');
    //         var url = window.URL.createObjectURL(data);
    //         a.href = url;
    //         a.download = 'numbers.csv';
    //         a.click();
    //         window.URL.revokeObjectURL(url);
    //     }
    // });

}