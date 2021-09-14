window.addEventListener("DOMContentLoaded", (e) => {
    e.preventDefault();

    /*MENU NAV TOGGLER*/
    let i = 0;
    $('#navToggler').on('click', () => {
        i++
        console.log(i);
        $('#navLayout').toggleClass('d-none');

        if ($('#navLayout').css('display') === 'none') {
            console.log('hey');
            $('#navLayout').slideDown("fast");
        } else {
            console.log('ho');
            $('#navLayout').slideUp("fast");
        }
    })
});