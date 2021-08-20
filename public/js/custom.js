$(document).on('change', 'select', function () {
    let values = [];

    // getting all selects of current sport
    let container = $(this).closest('.card-body');
    let selects = container.find('select');

    // getting values of neighbour selects
    selects.each(function () {
        if ($(this).val() !== "0") {
            values.push($(this).val())
        }
    })

    selects.each(function () {
        let selectEl = $(this)

        // showing all options in select
        selectEl.find('option').show()

        // hiding option in select if its value equals to current changed select
        values.forEach(function (value) {
            selectEl.find('option[value="' + value + '"]').hide()
        })
    })
});
