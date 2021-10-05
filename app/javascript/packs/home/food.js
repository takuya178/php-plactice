const tab = document.getElementById('tab')
const normal = document.getElementById('js-normalselect');
const abnormal = document.getElementById('js-ngselect');
const normalbtn = document.getElementById('normalbtn');
const ngbtn = document.getElementById('js-ngbtn');

console.log(normalbtn)



normalbtn.addEventListener('click', () => {
  normal.style.display = 'block'
  abnormal.style.display = 'none'
});
ngbtn.addEventListener('click', () => {
  normal.style.display = 'none'
  abnormal.style.display = 'block'
});
