(() => {
  const tab = document.getElementById('tab')
  const normal = document.getElementById('js-normalselect');
  const abnormal = document.getElementById('js-ngselect');
  const normalbtn = document.getElementById('js-normalbtn');
  const ngbtn = document.getElementById('js-ngbtn');
  const contents = document.querySelectorAll('#js-contents');
  const table = document.getElementById('food_table');
  console.log(table)
  const ngfood = document.getElementById('js-ngfood');


  ngfood.addEventListener('click', () => {
    location.href = '/ng_food_combinations' + location.search
  });

})();
