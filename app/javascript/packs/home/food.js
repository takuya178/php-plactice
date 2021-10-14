(() => {
  const tab = document.getElementById('tab')
  const normal = document.getElementById('js-normalselect');
  const abnormal = document.getElementById('js-ngselect');
  const normalbtn = document.getElementById('js-normalbtn');
  const ngbtn = document.getElementById('js-ngbtn');
  const contents = document.querySelectorAll('#js-contents');
  const MAX_SCROLL_LENGTH = 3;

  
// 「組み合わせ」ボタンと「成分量が多い組み合わせ」ボタン
  normalbtn.addEventListener('click', () => {
    normal.style.display = 'block'
    abnormal.style.display = 'none'
  });
  ngbtn.addEventListener('click', () => {
    normal.style.display = 'none'
    abnormal.style.display = 'block'
  });

})();
