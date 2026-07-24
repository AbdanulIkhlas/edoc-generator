function auto_grow(element) { //function yang digunakan untuk auto-grow height textarea
    element.style.height = "5px";
    element.style.height = (element.scrollHeight) + "px";
}

function preview_emr_data(json) {
    var jsonpretty = JSON.stringify(json, null, 2);

    Swal.fire({
        title: 'JSON Data',
        html: `<div style="text-align: left;"><pre>${jsonpretty}<pre><div>`,
        showCancelButton: false,
        confirmButtonText: 'Ok'
    });
}

function autocomplete(config) {
    var plholder = 'Pilih';
    if (config.placeholder !== undefined) {
        plholder = config.placeholder;
    }

    var limitdata = 10;
    if (config.limit_data !== undefined) {
        limitdata = config.limit_data;
    }

    $(config.element).select2({
        placeholder: plholder,
        ajax: {
            url: config.url,
            dataType: 'json',
            quietMillis: 100,
            data: function (params) {
                var query_params = {
                    page: params.page || 1,
                    q: params.term || ''
                };

                for (const x in config.query_params) {
                    query_params[x] = config.query_params[x];
                }
                console.log(query_params);

                return query_params;
            },
            processResults: function (data, params) {
                params.p = params.p || 1;

                return {
                    results: data.response.data,
                    pagination: {
                        more: (params.p * limitdata) < data.response.total
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 0,
        templateResult: function (repo) {
            if (repo.loading) return repo.text;

            return config.markup_template(repo);
        },
        templateSelection: function (repo) {
            return config.selection_template(repo, config.init_data) || repo.text;
        }
    });

}

function setSelect2(elem, value, text) {
    $(elem).empty();
    const newOption = $("<option></option>").val(value).text(text);
    $(elem).append(newOption).trigger('change');
}

function timeNow() {
    const current = new Date();
    const date = current.getFullYear() + '-' + ("0" + (current.getMonth() + 1)).slice(-2) + '-' + ("0" + current.getDate()).slice(-2);

    timeHour = current.getHours();
    timeHour = ("0" + timeHour).slice(-2);

    timeMinute = current.getMinutes();
    timeMinute = ("0" + timeMinute).slice(-2);

    const time = timeHour + ":" + timeMinute;
    const dateTime = date + ' ' + time;

    return { date, time };
}

function dateParse(date) {
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    let dateInput = date;
    const yyyy = dateInput.getFullYear();
    let mm = dateInput.getMonth() + 1; // Months start at 0!
    let dd = dateInput.getDate();
    let month = monthNames[mm - 1];

    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;

    // dateInput = `${yyyy}-${mm}-${dd}`;
    let dateDisplay = `${dd} ${month} ${yyyy}`;
    // return {dateInput, dateDisplay}
    return dateDisplay;
}

function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

// Show / hide next / previous button at the bottom of the page
// When changing page
function showHidePagination(index) {
    var items = $('#formadd .nav-item a.nav-link');
    if (index == 0) {
        $('#nexttab').removeClass('d-none');
        $('#prevtab').addClass('d-none');
    } else if (index == items.length - 1) {
        $('#prevtab').removeClass('d-none');
        $('#nexttab').addClass('d-none');
    } else {
        $('#nexttab').removeClass('d-none');
        $('#prevtab').removeClass('d-none');
    }
}

// Control next previous button
function controlPage(control, index) {
    var items = $('#formadd .nav-item a.nav-link'), pane = $('#formadd .tab-pane');
    console.log($('#formadd .nav-item a.nav-link'));
    console.log(pane);
    // nextzz
    switch (control) {
        case "next":
            if (index < items.length - 1) {
                window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
                index += 1;
                // for tab
                $(items[index - 1]).removeClass('active');
                $(items[index]).addClass('active');

                // for pane
                $(pane[index - 1]).removeClass('show active');
                $(pane[index]).addClass('show active');
            }
            if (items.length == 2 && index == items.length - 1) {
                $('#nexttab').addClass('d-none');
                $('#prevtab').removeClass('d-none');
            }
            else if (index == items.length - 1) {
                $('#nexttab').addClass('d-none');
            } else {
                $('#prevtab').removeClass('d-none');
            }
            break;
        case "prev":
            if (index != 0) {
                window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
                index -= 1;
                // for tab
                $(items[index + 1]).removeClass('active');
                $(items[index]).addClass('active');
                // for pane
                $(pane[index + 1]).removeClass('show active');
                $(pane[index]).addClass('show active');
            }
            if (items.length == 2 && index == 0) {
                $('#prevtab').addClass('d-none');
                $('#nexttab').removeClass('d-none');
            }
            else if (index == 0) {
                $('#prevtab').addClass('d-none');
            } else {
                $('#nexttab').removeClass('d-none');
            }
            break;
    }
    return index;
}