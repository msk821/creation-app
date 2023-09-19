import axios from "axios";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction"; // ※日付クリックに必要

// カレンダーを表示させたいタグのidを取得
var calendarEl = document.getElementById("calendar2");

if (calendarEl != null) {
    let initialEvents = []; // 初期表示用のカレンダーイベントを格納する配列

    // new Calender(カレンダーを表示させたいタグのid, {各種カレンダーの設定});
    let calendar = new Calendar(calendarEl, {
        // プラグインの導入(import忘れずに)
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],

        // カレンダー表示
        initialView: "dayGridMonth", // 最初に表示させるページの形式
        headerToolbar: {
            // ヘッダーの設定
            // コンマのみで区切るとページ表示時に間が空かず、半角スペースで区切ると間が空く（半角があるかないかで表示が変わることに注意）
            start: "prev,next today", // ヘッダー左（前月、次月、今日の順番で左から配置）
            center: "title", // ヘッダー中央（今表示している月、年）
            end: "dayGridMonth,timeGridWeek", // ヘッダー右（月形式、時間形式）
        },
        height: "auto", // 高さをウィンドウサイズに揃える

        events: initialEvents, // 初期表示用のカレンダーイベントを設定
        dateClick: function (info) {
            window.location.href = "/calendar/list?date=" + info.dateStr;
        },
    });

    // カレンダーのレンダリング
    calendar.render();

    document
        .getElementById("search-form")
        .addEventListener("submit", function (e) {
            e.preventDefault(); // ページのリロードを防ぐ

            const formData = new FormData(this);

            axios
                .post("/calendar/search", {
                    //title: formData.get("title"),
                    tag: formData.get('tag'),
                })
                .then((response) => {
                    // 検索結果をカレンダーのイベントに設定
                    calendar.getEventSources().forEach(function (eventSource) {
                        eventSource.remove(); // 既存のイベントを削除
                    });

                    calendar.addEventSource(response.data); // 新しいイベントを追加
                })
                .catch((error) => {
                    // バリデーションエラーなど
                    alert("検索に失敗しました。");
                });
        });
}

