// Public
    $(document).ready(function(){
        // Collaps Effect
        $('.menu-collaps').click(function(){
            let dataCollaps = $(this).data('collaps');

            $(`#collaps-${dataCollaps}`).slideToggle();
            $(`#collaps-${dataCollaps} li`).click(function(e){
                e.stopPropagation(); // Untuk menghentikan effect parrent
                // // Menghapus class yang ada
                // if ($('.list-navbar').hasClass('bg-custom-green-600')) {
                //     $('.list-navbar').removeClass('bg-custom-green-600');
                // } else {
                //     $('.list-navbar').removeClass('bg-custom-green-700');
                // }
                // $('.menu-collaps').removeClass('bg-custom-green-600');

                // // Menambahkan class yang baru
                // $(`#collaps-${dataCollaps}`).parent().addClass('bg-custom-green-600');
                // $(this).addClass('bg-custom-green-700');
            })
        });
    });
// End Public

// Navbar
    $(document).ready(function(){
        // Menu Toggle Navbar
        $('.menu-toggle').click(function(){
            console.log("COBA");
            $('#navbar').toggleClass('-translate-x-full translate-x-0');
        });

        // $('.list-navbar').click(function(){
        //     // Menghapus class yang ada
        //     if ($('.list-navbar').hasClass('bg-custom-green-600')) {
        //         $('.list-navbar').removeClass('bg-custom-green-600');
        //     } else {
        //         $('.list-navbar').removeClass('bg-custom-green-700');
        //     }
        //     $('.menu-collaps').removeClass('bg-custom-green-600');
            
        //     // Menambahkan class yang baru
        //     $(this).addClass('bg-custom-green-600');
        // })
    });
// End Navbar