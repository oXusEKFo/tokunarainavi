function toggleAccordion(id) {
    const content = document.getElementById(id);
    const button = document.querySelector(`button[onclick="toggleAccordion('${id}')"]`);

    if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "flex";
        button.classList.add('open');
        button.querySelector('.plus').textContent = '−';
    } else {
        content.style.display = "none";
        button.classList.remove('open');
        button.querySelector('.plus').textContent = '+';
    }
}

function selectItem(checkbox) {
    const label = checkbox.parentElement; // チェックボックスの親要素（label）を取得
    if (checkbox.checked) {
        label.classList.add('selected'); // チェックボックスが選択された場合、selectedクラスを追加
    } else {
        label.classList.remove('selected'); // チェックボックスが選択解除された場合、selectedクラスを削除
    }
}

function clearSelections() {
    // すべてのチェックボックスを取得
    const allCheckboxes = document.querySelectorAll('input[type="checkbox"]');

    allCheckboxes.forEach(checkbox => {
        checkbox.checked = false; // チェックボックスを解除
        checkbox.parentElement.classList.remove('selected'); // 親のlabelからselectedクラスを削除
    });

    // 全域ボタンの選択状態を解除
    const allAreaButtons = document.querySelectorAll('.accordion_item.full_width');
    allAreaButtons.forEach(button => {
        button.classList.remove('selected'); // 全域ボタンの選択状態を解除
    });
}

function selectAll(groupId, button) {
    const group = document.getElementById(groupId);
    const checkboxes = group.querySelectorAll('input[type="checkbox"]');
    const allSelected = Array.from(checkboxes).every(checkbox => checkbox.checked);

    checkboxes.forEach(checkbox => {
        checkbox.checked = !allSelected; // すべて選択または解除
        if (checkbox.checked) {
            checkbox.parentElement.classList.add('selected'); // 親のlabelにselectedクラスを追加
        } else {
            checkbox.parentElement.classList.remove('selected'); // 親のlabelからselectedクラスを削除
        }
    });

    // ボタン自体の選択状態を切り替え
    if (allSelected) {
        button.classList.remove('selected');
    } else {
        button.classList.add('selected');
    }
}

// change_btnがクリックされたときの処理
const changeButtons = document.querySelectorAll('.change_btn');

changeButtons.forEach(button => {
    button.addEventListener('click', function() {
        const popup = document.getElementById('popup');
        const overlay = document.querySelector('.overlay');

        // ポップアップとオーバーレイを表示
        popup.style.display = 'block';
        overlay.style.display = 'block';
    });
});

// 選択状態を保存する関数
function saveSelections() {
    const selectedValues = {};
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        selectedValues[checkbox.value] = checkbox.checked;
    });

    return selectedValues;
}

// 選択状態を復元する関数
function restoreSelections(selectedValues) {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        if (selectedValues[checkbox.value] !== undefined) {
            checkbox.checked = selectedValues[checkbox.value];
            if (checkbox.checked) {
                checkbox.parentElement.classList.add('selected');
            } else {
                checkbox.parentElement.classList.remove('selected');
            }
        }
    });
}

// ポップアップを切り替える関数
function togglePopup(popupId) {
    // すべてのポップアップを非表示にする
    const popups = document.querySelectorAll('.search_container');
    popups.forEach(popup => {
        popup.style.display = 'none';
    });

    // オーバーレイを非表示にする
    const overlay = document.querySelector('.overlay');
    overlay.style.display = 'none';

    // 指定されたポップアップを表示する
    const popupToShow = document.getElementById(popupId);
    if (popupToShow) {
        popupToShow.style.display = 'block';
        overlay.style.display = 'block'; // オーバーレイを表示
    }
}

// ポップアップを表示する関数
function showPopup(popupId) {
    const selectedValues = saveSelections();
    togglePopup(popupId);
    restoreSelections(selectedValues);
}

// 年齢ポップアップを表示する関数
function toggleAgePopup() {
    showPopup('popup_age');
}

// エリアポップアップを表示する関数
function toggleAreaPopup() {
    showPopup('popup_area');
}

// ジャンルポップアップを表示する関数
function toggleGenrePopup() {
    showPopup('popup_genre');
}

// オーバーレイをクリックしたときにポップアップを閉じる
document.querySelector('.overlay').addEventListener('click', function() {
    this.style.display = 'none'; // オーバーレイを非表示
    const popups = document.querySelectorAll('.search_container');
    popups.forEach(popup => {
        popup.style.display = 'none'; // ポップアップを非表示
    });
});

// ポップアップを閉じる関数
function closePopup() {
    const popups = document.querySelectorAll('.search_container');
    popups.forEach(popup => {
        popup.style.display = 'none'; // ポップアップを非表示
    });

    // オーバーレイを非表示にする
    const overlay = document.querySelector('.overlay');
    overlay.style.display = 'none';
}

// オーバーレイをクリックしたときにポップアップを閉じる
document.querySelector('.overlay').addEventListener('click', closePopup);
