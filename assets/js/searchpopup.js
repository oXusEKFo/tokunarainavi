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

function selectItem(button) {
    button.classList.toggle('selected');
}

function clearSelections() {
    const selectedItems = document.querySelectorAll('.accordion_item.selected');
    selectedItems.forEach(item => item.classList.remove('selected'));
}

function selectAll(groupId, button) {
    const group = document.getElementById(groupId);
    const buttons = group.getElementsByClassName('accordion_item');
    const allSelected = Array.from(buttons).every(btn => btn.classList.contains('selected'));

    for (let btn of buttons) {
        if (allSelected) {
            btn.classList.remove('selected'); // すべて解除
        } else {
            btn.classList.add('selected'); // すべて選択
        }
    }

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
