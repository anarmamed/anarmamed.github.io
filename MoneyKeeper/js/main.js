'use strict';

let startBtn = document.getElementById("start"),
	budgetValue = document.getElementsByClassName('budget-value')[0],
	dayBudgetValue = document.getElementsByClassName('daybudget-value')[0],
	levelValue = document.getElementsByClassName('level-value')[0],
	expensesValue = document.getElementsByClassName('expenses-value')[0],
	incomeValue = document.getElementsByClassName('income-value')[0],
    monthSavingsValue = document.getElementsByClassName('monthsavings-value')[0],
    yearSavingsValue = document.getElementsByClassName('yearsavings-value')[0],

    expensesItem = document.getElementsByClassName('expenses-item'),
    expensesBtn = document.getElementsByTagName('button')[1],
    countBtn = document.getElementsByTagName('button')[2],
	incomeItem = document.querySelector('.choose-income'),
	checkSavings = document.querySelector('#savings'),
	sumValue = document.querySelector('.choose-sum'),
    percentValue = document.querySelector('.choose-percent');
    
let money, time; // объявил глобальные переменные, чтобы они были видны во всей программе

let appData = { // Глобальный объект
    budget: money,
    timeData: time,
    expenses: {},
    optionalExpenses: {},
    income : [],
    savings: false,
};    


expensesBtn.disabled = true; // кнопка не доступна по умолчанию
countBtn.disabled = true;// кнопка не доступна по умолчанию


startBtn.addEventListener('click', function() { // для  элемента startBtn(кнопка с классом start) после события click выполняется функция
   
    money = +prompt('Введите Ваш доход в месяц:', ''); // прошу пользователя ввести числовое значение в модальное окно
   
    while(isNaN(money) || money == "" || money == null) { // цикл с выводом мод. окна будет продолжаться до тех пор пока пользовательское значение будет пустой строкой, null или НЕ цифрам 
        money = +prompt('Ваш бюджет на месяц?', ''); 
    }
    appData.budget = money; // введенные данные пользователя(переменная money) поместил в глобальный объект appData в ключ budget
    budgetValue.textContent = money.toFixed(); // поместил в div с классом budget-value данные,округленные(toFixed), из переменной money  

    expensesBtn.disabled = false; // кнопка становится доступной после выполнения функции и обработки события
    countBtn.disabled = false;// кнопка становится доступной после выполнения функции и обработки события
});



expensesBtn.addEventListener('click', function() { // для  элемента expensesBtn(кнопка с классом expenses-item-btn) после события click выполняется функция
    
    let sum = 0;

    for (let i = 0; i < expensesItem.length; i++) { //переменная начинается с нуля, заканчивается последним элементом и каждый раз увеличивается на 1
        let a = expensesItem[i].value, // присваивается значение "наименование" расходов из инпута(value)
            b = expensesItem[++i].value; // присваивается значение "цена"(value) введенное пользоавтелем в инпут 

        if( (typeof(a)) != null && (typeof(b)) != null  && a !='' && b !='' && a.length < 50) { // проверка
            appData.expenses[a] = b; // в глобальный объект appData добавляется новое свойство с ключем и значением
            sum += +b; // сумма всех значений которые пользователь ввел в инпут "цена"
        } else {
            i = i - 1; // цикл возвращается на одно повторение назад  
        }      
    }
    expensesValue.textContent = sum; // значение переменной sum записывается на странице в блок с классом expenses-value 
});



countBtn.addEventListener('click', function() { // расчет бюджета на день

    if(appData.budget != undefined) { // проверка, если пользователь не ввел никаких данных 
        appData.moneyPerDay = ((appData.budget - +expensesValue.textContent ) / 30).toFixed(); // расчет бюджета на один день c учетом все расходов с округлением
        dayBudgetValue.textContent = appData.moneyPerDay; // добавляю результат расчета в блок с классом daybudget-value
        if(appData.moneyPerDay < 100) {
            levelValue.textContent = "Минимальный";
        } else if(appData.moneyPerDay > 100 && appData.moneyPerDay < 2000){
            levelValue.textContent = "Средний";
        } else if(appData.moneyPerDay > 2000) {
            levelValue.textContent = "Высокий";
        }
    } else {
        dayBudgetValue.textContent = "Ошибка! Начните рассчет";
    }
});



checkSavings.addEventListener('click', function() { 
    if(appData.savings == true) {
        appData.savings = false;
    } else appData.savings =true;
});



sumValue.addEventListener('input', function() {
    if(appData.savings == true) {
        let sum = +sumValue.value,
            percent = +percentValue.value;

        appData.monthIncome = sum/100/12*percent;
        appData.yearIncome = sum/100*percent;

        monthSavingsValue.textContent = appData.monthIncome.toFixed(1);
        yearSavingsValue.textContent = appData.yearIncome.toFixed(1);
    }
});

percentValue.addEventListener('input', function() {
    if(appData.savings == true) {
        let sum = +sumValue.value,
            percent = +percentValue.value;

        appData.monthIncome = sum/100/12*percent;
        appData.yearIncome = sum/100*percent;

        monthSavingsValue.textContent = appData.monthIncome.toFixed(1);
        yearSavingsValue.textContent = appData.yearIncome.toFixed(1);
    }
});