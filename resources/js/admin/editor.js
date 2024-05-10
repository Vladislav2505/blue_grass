import EditorJS from '@editorjs/editorjs';
import Embed from '@editorjs/embed';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import Underline from '@editorjs/underline';
import Delimiter from '@editorjs/delimiter';
import Paragraph from 'editorjs-paragraph-with-alignment';
import FontSize from 'editorjs-inline-font-size-tool';

const editorjs = document.getElementById('editorjs');
if (editorjs) {
    const dataAttribute = editorjs.getAttribute('data');
    let jsonData = '';

    try {
        if (dataAttribute.length > 0) {
            jsonData = JSON.parse(dataAttribute);
        }
    } catch (error) {
        console.log('Ошибка при парсинге JSON')
    }


    const editor = new EditorJS({
        onChange(api, event) {
            removeElementsWithClass()
        },
        holder: 'editorjs',
        data: jsonData,
        tools: {
            delimiter: Delimiter,
            fontSize: FontSize,
            underline: Underline,
            paragraph: {
                class: Paragraph,
                inlineToolbar: true,
            },
            list: {
                class: List,
                inlineToolbar: [
                    'link',
                    'bold',
                    'underline',
                ]
            },
            embed: {
                class: Embed,
                inlineToolbar: false,
                config: {
                    services: {
                        youtube: true,
                    },
                },
            },
        },
        minHeight: 150,
        placeholder: 'Введите текст',
        i18n: {
            messages: {
                ui: {
                    "blockTunes": {
                        "toggler": {
                            "Click to tune": "Нажмите, чтобы настроить",
                            "or drag to move": "или перетащите"
                        },
                    },
                    "inlineToolbar": {
                        "converter": {
                            "Convert to": "Конвертировать в"
                        }
                    },
                    "toolbar": {
                        "toolbox": {
                            "Add": "Добавить"
                        }
                    }
                },

                /**
                 * Section for translation Tool Names: both block and inline tools
                 */
                toolNames: {
                    "Text": "Параграф",
                    "Heading": "Заголовок",
                    "List": "Список",
                    "Warning": "Примечание",
                    "Checklist": "Чеклист",
                    "Quote": "Цитата",
                    "Code": "Код",
                    "Delimiter": "Разделитель",
                    "Raw HTML": "HTML-фрагмент",
                    "Table": "Таблица",
                    "Link": "Ссылка",
                    "Marker": "Маркер",
                    "Bold": "Полужирный",
                    "Italic": "Курсив",
                    "InlineCode": "Моноширинный",
                    "Underline": "Подчеркивание",
                },

                /**
                 * Section for passing translations to the external tools classes
                 */
                tools: {
                    /**
                     * Each subsection is the i18n dictionary that will be passed to the corresponded plugin
                     * The name of a plugin should be equal the name you specify in the 'tool' section for that plugin
                     */
                    "warning": { // <-- 'Warning' tool will accept this dictionary section
                        "Title": "Название",
                        "Message": "Сообщение",
                    },

                    /**
                     * Link is the internal Inline Tool
                     */
                    "link": {
                        "Add a link": "Вставьте ссылку"
                    },
                    /**
                     * The "stub" is an internal block tool, used to fit blocks that does not have the corresponded plugin
                     */
                    "stub": {
                        'The block can not be displayed correctly.': 'Блок не может быть отображен'
                    }
                },

                /**
                 * Section allows to translate Block Tunes
                 */
                blockTunes: {
                    /**
                     * Each subsection is the i18n dictionary that will be passed to the corresponded Block Tune plugin
                     * The name of a plugin should be equal the name you specify in the 'tunes' section for that plugin
                     *
                     * Also, there are few internal block tunes: "delete", "moveUp" and "moveDown"
                     */
                    "delete": {
                        "Delete": "Удалить"
                    },
                    "moveUp": {
                        "Move up": "Переместить вверх"
                    },
                    "moveDown": {
                        "Move down": "Переместить вниз"
                    }
                },
            }
        },
    });

    document.getElementById('save')?.addEventListener('click', function (event) {
        event.preventDefault(); // Отменяем стандартное действие кнопки

        // Сохраняем данные редактора
        editor.save().then((outputData) => {
            // Устанавливаем значения в скрытый input
            document.getElementById('editorData').value = JSON.stringify(outputData);

            // Получаем ближайшую форму
            const form = event.target.closest('form');

            // Отправляем форму
            form.submit();
        }).catch((error) => {
            console.error('Saving failed: ', error);
        });
    });

    function removeElementsWithClass() {
        const elementsToRemove = document.querySelectorAll('.ct, .ct--top, .ct--shown');
        elementsToRemove.forEach(element => {
            element.remove();
        });
    }
}
