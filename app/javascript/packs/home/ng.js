const normalbtn = document.getElementById('js-normalbtn');

normalbtn.addEventListener('click', () => {
  ref = document.referrer
  location.href = ref;
});