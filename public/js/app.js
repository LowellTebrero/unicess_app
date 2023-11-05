


    document.getElementById('filter_faculty_id').addEventListener('change', function(){

        let facultyId = this.value || this.options[this.selectedIndex].value
        window.location.href = window.location.href.split('?')[0] + '?faculty_id=' + facultyId
    });


    document.getElementById('btn-clear').addEventListener('click', function() {
        let input = document.getElementById('search'),
        select = document.getElementById('filter_faculty_id')

        input.value = ""
        select.selectedIndex = 0
        window.location.href = window.location.href.split('?')[0]
    })

    const toggleClearButton = () => {

        let query = location.search,
        pattern = /[?&]search=/,
        button = document.getElementById('btn-clear')

        if(pattern.test(query)){
            button.style.display = "block"
        }else {
            button.style.display = "none"
        }

    }

    toggleClearButton()


