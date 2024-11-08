<template>
    <div>
        <div class="main-container">
            <div class="editor-container editor-container_document-editor" ref="editorContainerElement">
                <div class="editor-container__menu-bar" ref="editorMenuBarElement"></div>
                <div class="editor-container__toolbar" ref="editorToolbarElement"></div>
                <div class="editor-container__editor-wrapper">
                    <div class="editor-container__editor">
                        <div ref="editorElement">
                            <ckeditor v-if="isLayoutReady" v-model="this.$store.state.content" :editor="editor" :config="config" @ready="onReady" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {
    DecoupledEditor,
    AccessibilityHelp,
    Alignment,
    Autoformat,
    AutoImage,
    AutoLink,
    Autosave,
    BalloonToolbar,
    Base64UploadAdapter,
    Bold,
    Code,
    Essentials,
    FindAndReplace,
    FontBackgroundColor,
    FontColor,
    FontFamily,
    FontSize,
    Heading,
    HorizontalLine,
    ImageBlock,
    ImageCaption,
    ImageInline,
    ImageInsert,
    ImageInsertViaUrl,
    ImageResize,
    ImageStyle,
    ImageTextAlternative,
    ImageToolbar,
    ImageUpload,
    Indent,
    IndentBlock,
    Italic,
    Link,
    LinkImage,
    List,
    ListProperties,
    MediaEmbed,
    PageBreak,
    Paragraph,
    RemoveFormat,
    SelectAll,
    SpecialCharacters,
    SpecialCharactersArrows,
    SpecialCharactersCurrency,
    SpecialCharactersEssentials,
    SpecialCharactersLatin,
    SpecialCharactersMathematical,
    SpecialCharactersText,
    Strikethrough,
    Subscript,
    Superscript,
    Table,
    TableCaption,
    TableCellProperties,
    TableColumnResize,
    TableProperties,
    TableToolbar,
    TextTransformation,
    TodoList,
    Underline,
    Undo
} from 'ckeditor5';

import translations from 'ckeditor5/translations/ru.js';

import 'ckeditor5/ckeditor5.css';

export default {
    name: 'Editor',
    data() {
        return {
            isLayoutReady: false,
            config: null, // CKEditor needs the DOM tree before calculating the configuration.
            editor: DecoupledEditor
        };
    },
    mounted() {
        this.config = {
            toolbar: {
                items: [
                    'undo',
                    'redo',
                    '|',
                    'heading',
                    '|',
                    'fontSize',
                    'fontFamily',
                    'fontColor',
                    'fontBackgroundColor',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    '|',
                    'link',
                    //'insertImage',
                    'insertTable',
                    '|',
                    'alignment',
                    '|',
                    'bulletedList',
                    'numberedList',
                    'todoList',
                    'outdent',
                    'indent'
                ],
                shouldNotGroupWhenFull: false
            },
            plugins: [
                AccessibilityHelp,
                Alignment,
                Autoformat,
                AutoImage,
                AutoLink,
                Autosave,
                BalloonToolbar,
                Base64UploadAdapter,
                Bold,
                Code,
                Essentials,
                FindAndReplace,
                FontBackgroundColor,
                FontColor,
                FontFamily,
                FontSize,
                Heading,
                HorizontalLine,
                ImageBlock,
                ImageCaption,
                ImageInline,
                ImageInsert,
                ImageInsertViaUrl,
                ImageResize,
                ImageStyle,
                ImageTextAlternative,
                ImageToolbar,
                ImageUpload,
                Indent,
                IndentBlock,
                Italic,
                Link,
                LinkImage,
                List,
                ListProperties,
                MediaEmbed,
                PageBreak,
                Paragraph,
                RemoveFormat,
                SelectAll,
                SpecialCharacters,
                SpecialCharactersArrows,
                SpecialCharactersCurrency,
                SpecialCharactersEssentials,
                SpecialCharactersLatin,
                SpecialCharactersMathematical,
                SpecialCharactersText,
                Strikethrough,
                Subscript,
                Superscript,
                Table,
                TableCaption,
                TableCellProperties,
                TableColumnResize,
                TableProperties,
                TableToolbar,
                TextTransformation,
                TodoList,
                Underline,
                Undo
            ],
            balloonToolbar: ['bold', 'italic', '|', 'link', 'insertImage', '|', 'bulletedList', 'numberedList'],
            fontFamily: {
                supportAllValues: true
            },
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            heading: {
                options: [
                    {
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            image: {
                toolbar: [
                    'toggleImageCaption',
                    'imageTextAlternative',
                    '|',
                    'imageStyle:inline',
                    'imageStyle:wrapText',
                    'imageStyle:breakText',
                    '|',
                    'resizeImage'
                ]
            },
            language: 'ru',
            link: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                decorators: {
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            menuBar: {
                isVisible: true
            },
            placeholder: 'Введите или вставьте контент здесь!',
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
            },
            translations: [translations]
        };

        this.isLayoutReady = true;
    },
    methods: {
        onReady(editor) {
            Array.from(this.$refs.editorToolbarElement.children).forEach(child => child.remove());
            Array.from(this.$refs.editorMenuBarElement.children).forEach(child => child.remove());

            this.$refs.editorToolbarElement.appendChild(editor.ui.view.toolbar.element);
            this.$refs.editorMenuBarElement.appendChild(editor.ui.view.menuBarView.element);
        }
    }
};
</script>

<style>

/* ---- Basic CSS reset ------------------------------------------------------ */
*, ::after, ::before {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    margin: 0;
}

body,
html {
    margin: 0;
    padding: 0;
}

.ck.ck-content.ck-editor__editable_inline > :first-child {
    margin-top: 0;
}

/* ---- Styles of the demo page ------------------------------------------------------ */
.editor-wrapper {
    max-width: 66rem;
    margin: 0 auto 2rem auto;
}

.header-wrapper {
    padding: 1rem 2rem;
}

/* ---- Styles specific to the mobile editor demo ------------------------------------------------------ */
@media screen and (min-width: 800px) {
    #mobile-wrapper {
        --ck-demo-notch-height: 28px;
        --ck-demo-notch-width: 180px;
        --ck-demo-notch-border-radius: 15px;
        --ck-demo-phone-border-size: 12px;
        --ck-demo-phone-border-color: #000;
        --ck-demo-phone-border-radius: 50px;
        --ck-demo-phone-top-padding: calc(var(--ck-demo-notch-height) + 15px);
        --ck-demo-phone-height: 898px;
        --ck-demo-phone-width: 443px;
        --ck-demo-iframe-border-radius: 40px;
        /* Size of Iphone 12/12 Pro: 390 x 844 */
        max-width: calc(var(--ck-demo-phone-width) - 2 * var(--ck-demo-phone-border-size));
        height: calc(var(--ck-demo-phone-height) - 2 * var(--ck-demo-phone-border-size) + var(--ck-demo-phone-top-padding));
        position: relative;
        padding-top: var(--ck-demo-phone-top-padding);
        margin: auto;
        border: var(--ck-demo-phone-border-size) solid var(--ck-demo-phone-border-color);
        border-radius: var(--ck-demo-phone-border-radius);
    }
    #mobile-wrapper::before {
        content: "";
        background: #000;
        width: var(--ck-demo-notch-width);
        height: var(--ck-demo-notch-height);
        display: block;
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 0 0 var(--ck-demo-notch-border-radius) var(--ck-demo-notch-border-radius);
    }
    #mobile-wrapper::after {
        content: "";
        display: block;
        background: var(--ck-demo-phone-border-color);
        width: calc(var(--ck-demo-notch-width) + 2 * var(--ck-demo-notch-border-radius));
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
        height: var(--ck-demo-notch-border-radius);
        --mask: radial-gradient(
            var(--ck-demo-notch-border-radius) at var(--ck-demo-notch-border-radius) 100%,
            #0000 98%,
            var(--ck-demo-phone-border-color)) calc( -1 * var(--ck-demo-notch-border-radius));
        -webkit-mask: var(--mask);
        mask: var(--mask);
    }
    #mobile-wrapper iframe {
        border-radius: 0 0 var(--ck-demo-iframe-border-radius);
        border: none;
    }
}
@media screen and (max-width: 800px) {
    #mobile-wrapper {
        --ck-demo-iframe-height: 850px;
        height: var(--ck-demo-iframe-height);
    }
    #mobile-wrapper iframe {
        width: 100%;
        border: 0;
    }
}

</style>

