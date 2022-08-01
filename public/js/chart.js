; ((D, B, log = arg => console.log(arg)) => {
  let size = D.querySelector('#size').value;

  let sColors = [
    "#999999",
    "#348af0",
    "#9a1599",
    "#ce000b",
    "#8c7fc1",
    "#308b1c",
    "#00afb2",
    "#fecd5b",
    "#f17a73",
    "#73c18a",
    ];


  let sCatNames = D.querySelectorAll('.catNames');
  let sLables = D.querySelectorAll('.lables');
  let sPercents = D.querySelectorAll('.gPercents');
  let catNames = [];
  let lables = [];
  for (const catName of sCatNames) {
    catNames.push(catName.value);
  }

  for (const label of sLables) {
    lables.push(label.value);
  }

  let gPercents = [];
  let sumPers = 0;
  for (const gPerc of sPercents) {
    gPercents.push(+gPerc.value);
    sumPers += +gPerc.value;
  }
  gPercents.unshift(100 - sumPers);

  let data = [];
  for (let i = 0; i < size; i++) {
    let dt = [];
    let sData = D.querySelectorAll('.data_' + i);
    for (let j = 0; j < sData.length; j++) {
      dt.push(sData[j].value * 100);

    }
    data.push(dt);
  }
  console.log(catNames);
  console.log(lables);
  console.log(data);
  console.log(gPercents);
  let colors = [];

  for (let i = 0; i < size; i++) {
    colors.push(sColors[i + 1]);
  }

  var ctx = D.querySelector('#myChart').getContext('2d');

  let objs = [];
  for (let i = 0; i < size; i++) {

    objs.push({
      label: catNames[i],
      borderColor: colors[i],
      data: data[i],
    });

    log("#" + (3 * (i + 1) + "" + (i + 1)) + "f");
  }


  let chart = new Chart(ctx, {
    type: 'line',

    data: {
      labels: lables,
      datasets: objs,
    },


    options: {}
  });


  catNames.unshift("empty");
  colors.unshift(sColors[0]);

  console.log(catNames);
  console.log(colors);
  var ctx2 = D.querySelector('#myChart2').getContext('2d');

  let objs2 = [];

  objs2.push({
    label: "Аллокация",
    backgroundColor: colors,
    borderColor: "#454545",
    data: gPercents,
  });


  let chart2 = new Chart(ctx2, {
    type: 'doughnut',

    data: {
      labels: catNames,
      datasets: objs2,
    },


    options: {}
  });
})(document, document.body)

