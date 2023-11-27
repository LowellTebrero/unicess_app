
let button = document.querySelector(".btn-slide")
let sidebar = document.querySelector(".sidebar")
let closebutton = document.querySelector(".close-button")

button.addEventListener('click',() => {
    sidebar.classList.toggle('active');
  });

closebutton.addEventListener('click',() => {
    sidebar.classList.remove('active');
  });


// let button = document.querySelector(".btn-slide")
// let sidebar = document.querySelector(".sidebar")
// const panels = document.querySelectorAll('.panel')
// let navbar = document.querySelector('.navbar-dashboard')

// button.addEventListener('click',() => {
//     sidebar.classList.toggle('active');
//     document.getElementById('hero-section').classList.toggle('remove-margin');
//     document.getElementById('show-tag').classList.toggle('show-a-tag');
//   });

// button.addEventListener('click',() => {
//     navbar.classList.toggle('navbar-dashboard-slider');
//     console.log('navbar')
// });


// panels.forEach(panel => {
//     panel.addEventListener('click', () => {
//         removeActiveClasses()
//         panel.classList.add('add-background')
//         console.log(panels)
//     })
// })

// function removeActiveClasses() {
//     panels.forEach(panel => {
//         panel.classList.remove('add-background')
//     })
// }






