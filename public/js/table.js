; ((D, B, log = (...arg) => console.log(...arg)) => {
  let trs = D.querySelectorAll('table tr:not(:first-child)');

  function round(v) {
    return Math.round(v);
  }

  for (let tr of trs) {

    let tds = tr.querySelectorAll('tr td');
    let sum = 0;
    let fdc;
    let count = 0;
    for (let i = 0; i < tds.length; i++) {
      let dataCell = tds[i].dataset.cell;
      if (/^_\d+\D\D-\d+$/.test(tds[i].dataset.cell)) {
        count++;
        if (count == 1) {
          fdc = i;
        }
        sum += +tds[i].textContent;
        console.log(fdc);

        if (sum != 0) {
          if (tds[i].textContent != 100) {

            tds[i].addEventListener('click', function func() {

              if (i > fdc && i < tds.length - 1) {
                let lOfset = 0;
                let lSum = 0;
                while (i - lOfset > fdc) {
                  if (tds[i - lOfset].previousElementSibling.textContent > 0) {
                    lSum += +tds[i - lOfset].previousElementSibling.textContent;
                  }
                  lOfset++;
                }

                let lQty = 0;
                let rOfset = 0;
                let rQty = 0;
                while (i + rOfset < tds.length - 1) {
                  if (tds[i].nextElementSibling.textContent == 0) {
                    let lSum = +tds[i].textContent;
                    while (lSum < 99.5 && i - lQty > fdc) {
                      lSum += +tds[i - lQty].previousElementSibling.textContent;
                      lQty++;
                    }
                    rOfset = tds.length;
                  } else {
                    if (tds[i + rOfset].nextElementSibling.textContent > 0) {
                      rQty++;
                    }
                    rOfset++;
                  }
                }

                if (lQty > 0) {
                  let restPer = 100 / (lQty + 1);
                  while (lQty >= 0) {
                    tds[i - lQty].textContent = restPer.toFixed(1);
                    tds[i - lQty].innerHTML +=
                      `<input
                        name="${tds[i - lQty].dataset.cell}"
                        value="${restPer / 100}"
                        hidden
                      >`;
                    lQty--;
                  }
                  tds[i].innerHTML +=
                    `<input
                      name="_unblocked-${tds[i].dataset.cell.split("-")[1]}"
                      value="${tds[i].dataset.cell.match(/(\d+)/g)[0]}"
                      hidden
                    >`;
                } else {

                  let maxVal = 100 - lSum;
                  let selectxt = '';
                  selectxt = `<select name="${dataCell}" id="${dataCell}"><option  hidden></option>`;

                  for (let j = 0; j <= maxVal; j++) {
                    selectxt += `<option value="${j}">${j}</option>`;
                  }
                  selectxt += `</select>`;
                  tds[i].innerHTML = selectxt;
                  let select = D.querySelector(`#${dataCell}`);

                  select.addEventListener('change', function () {
                    // rQty++;
                    console.log(rQty);

                    let restPer = (100 - lSum - select.value) / rQty;
                    tds[i].textContent = select.value;
                    tds[i].innerHTML +=
                      `<input
                      name="${tds[i].dataset.cell}"
                      value="${select.value / 100}"
                      hidden
                      >`;

                    let lastRight = 0;
                    while (rQty > 0) {
                      tds[i + rQty].textContent = round(restPer).toFixed(1);

                      tds[i + rQty].innerHTML +=
                        `<input
                        name="${tds[i + rQty].dataset.cell}"
                        value="${restPer / 100}"
                        hidden
                        >`;

                      rQty--;
                      lastRight++;
                    }

                    if (tds[i + 1].textContent == 0) {
                      tds[i].innerHTML +=
                        `<input
                            name="_unblocked-${tds[i].dataset.cell.split("-")[1]}"
                            value="${tds[i].dataset.cell.match(/(\d+)/g)[0]}"
                            hidden
                        >`;
                    } else {
                      tds[i + lastRight].innerHTML +=
                        `<input
                      name="_unblocked-${tds[i].dataset.cell.split("-")[1]}"
                      value="${tds[i + lastRight].dataset.cell.match(/(\d+)/g)[0]}"
                      hidden
                       >`;
                    }
                    tds[i].addEventListener('click', func);
                  });
                }

              } else if (i == fdc) {

                let rOfset = 0;
                let rQty = 0;
                while (i + rOfset < tds.length - 1) {
                  if (tds[i + rOfset].nextElementSibling.textContent > 0) {
                    rQty++;
                  }
                  rOfset++;
                }

                let maxVal = 100;
                let selectxt = '';
                selectxt = `<select name="${dataCell}" id="${dataCell}"><option  hidden></option>`;

                for (let k = 0; k <= maxVal; k++) {
                  selectxt += `<option value="${k}">${k}</option>`;
                }
                selectxt += `</select>`;
                tds[i].innerHTML = selectxt;
                let select = D.querySelector(`#${dataCell}`);

                select.addEventListener('change', function () {
                  console.log('select.value: ', select.value);
                  let restPer = (100 - select.value) / rQty;
                  tds[i].innerHTML = select.value;

                  while (rQty > 0) {
                    tds[i + rQty].textContent = restPer.toFixed(1);
                    console.log('rQty: ', rQty);
                    rQty--;
                  }
                  tds[i].addEventListener('click', func);
                });

              } else {

                let lQty = 0;
                let lSum = +tds[i].textContent;
                while (lSum < 99.5 && i - lQty > fdc) {
                  lSum += +tds[i - lQty].previousElementSibling.textContent;
                  lQty++;
                }

                let restPer = 100 / (lQty + 1);
                while (lQty >= 0) {
                  tds[i - lQty].textContent = restPer.toFixed(1);
                  tds[i - lQty].innerHTML +=
                    `<input
                      name="${tds[i - lQty].dataset.cell}"
                      value="${restPer / 100}"
                      hidden
                      >`;
                  lQty--;
                }
                tds[i].innerHTML +=
                  `<input
                    name="_unblocked-${tds[i].dataset.cell.split("-")[1]}"
                    value="${tds[i].dataset.cell.match(/(\d+)/g)[0]}"
                    hidden
                  >`;
              }
              tds[i].removeEventListener('click', func);
            });
          }
        }
      } else {
        if (i != 0) {
          tds[i].addEventListener('click', function func2() {
            let input = document.createElement('input');
            input.value = tds[i].textContent;
            tds[i].textContent = "";
            tds[i].appendChild(input);

            input.addEventListener('blur', function () {
              tds[i].innerHTML = this.value;
              tds[i].innerHTML +=
                `<input
                  name="${tds[i].dataset.cell}"
                  value="${this.value / 100}"
                  hidden
                >`;
              tds[i].addEventListener('click', func2);
            });
            tds[i].removeEventListener('click', func2);
          });
        }
      }
    }
  }

})(document, document.body, this)