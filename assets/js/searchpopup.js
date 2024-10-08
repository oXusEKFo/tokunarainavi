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

function togglePopup(popupId) {
    const popup = document.getElementById(popupId);
    const overlay = document.querySelector('.overlay');
    const isVisible = popup.style.display === 'block';
    popup.style.display = isVisible ? 'none' : 'block';
    overlay.style.display = isVisible ? 'none' : 'block';
}

// ポップアップ、閉じるボタンを取得
const closeBtns = document.querySelectorAll('.close_button');
const overlays = document.querySelectorAll('.overlay');

// 各閉じるボタンにイベントリスナーを追加
closeBtns.forEach(closeBtn => {
    closeBtn.addEventListener('click', function() {
        const popup = closeBtn.closest('.search_container');
        const overlay = document.querySelector('.overlay');
        popup.style.display = 'none';
        overlay.style.display = 'none'; // オーバーレイも非表示にする
    });
});

// ポップアップの外側がクリックされた時も非表示にする
overlays.forEach(overlay => {
    overlay.addEventListener('click', function(event) {
        // クリックされた要素がポップアップの外側であることを確認
        if (event.target === overlay) {
            const popups = document.querySelectorAll('.search_container');
            popups.forEach(popup => {
                popup.style.display = 'none'; // すべてのポップアップを非表示にする
            });
            overlay.style.display = 'none'; // オーバーレイも非表示にする
        }
    });
});
