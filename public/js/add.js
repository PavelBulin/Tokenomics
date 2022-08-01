; ((D, B, log = arg => console.log(arg)) => {

  let baseTime = D.querySelector('#baseDate').value * 1000;

  console.log(baseTime);

  let now = new Date();
  let currTime = new Date(now.getFullYear(), now.getMonth(), 1, 6);
  console.log(currTime.getTime());
  let ofsetTime = Math.round((currTime - baseTime) / (1000 * 60 * 60 * 24 * 10)) / 3;
  console.log(ofsetTime);

  let select = `<select name="unblocked" id="selectFinish"><option  hidden>Месяц</option>`;
  let today = now.getDay();

  for (let i = ofsetTime; i < 49; i++) {
    select += `<option value="${i}">${i + 1}Mo</option>`;
  }
  select += `</select>`;

  let form = D.querySelector('form');
  let p = D.createElement('p');
  let btn = D.querySelector('input[type="submit"]');
  p.innerHTML = select;
  form.insertBefore(p, btn);


  let inpShow = D.createElement('input');
  let input = '<input name="firstPersent" id="firstPersent" hidden>';

  inpShow.value = '100%';
  inpShow.disabled = true;
  form.insertBefore(inpShow, btn);
  btn.insertAdjacentHTML("beforebegin", input);

  let inpData = D.querySelector('#firstPersent');
  input = '<input name="restPersent" id="restPersent" hidden>';
  btn.insertAdjacentHTML("beforebegin", input);
  let inpRest = D.querySelector('#restPersent');

  let period;
  let selectFinish = D.querySelector('#selectFinish')
  selectFinish.addEventListener("change", function () {
    let choosenDay = this.value;

    let firstPersent = 1;
    if (choosenDay == ofsetTime) {
      inpShow.value = '100%';
      inpData.value = 1;
      inpRest.value = 0;
      inpShow.disabled = true;
    } else {
      period = choosenDay - ofsetTime + 1;
      let percent = (firstPersent / period);
      inpShow.value = (percent * 100).toFixed(1) + '%';
      inpData.value = percent;
      inpRest.value = percent;
      inpShow.disabled = false;
    }

  });

  inpShow.addEventListener("input", function () {
    inpData.value = this.value / 100;
    inpRest.value = (100 - this.value) / (period - 1) / 100;
  });


})(document, document.body)