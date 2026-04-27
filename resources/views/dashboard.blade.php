<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Inter', -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif}

/* CSS Reset and Base Styles */
html {
    font-size: 16px;
    scroll-behavior: smooth;
}

body {
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

img {
    max-width: 100%;
    height: auto;
}

button {
    border: none;
    outline: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

button:focus {
    outline: 2px solid #25D366;
    outline-offset: 2px;
}

input, textarea {
    outline: none;
    border: none;
}

input:focus, textarea:focus {
    outline: 2px solid #25D366;
    outline-offset: 2px;
}

/* Utility Classes */
.text-center { text-align: center; }
.text-left { text-align: left; }
.text-right { text-align: right; }
.d-flex { display: flex; }
.align-center { align-items: center; }
.justify-center { justify-content: center; }
.justify-between { justify-content: space-between; }
.flex-1 { flex: 1; }
.hidden { display: none; }
.visible { display: block; }
.opacity-0 { opacity: 0; }
.opacity-1 { opacity: 1; }

/* Scrollbar Styling */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    background: #3b4a54;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #4a5564;
}

body{
    display:flex;
    height:100vh;
    background:#111b21;
    overflow:hidden;
}

/* SIDEBAR */
.sidebar{
    width:30%;
    min-width:300px;
    background:#202c33;
    color:white;
    display:flex;
    flex-direction:column;
    border-right:1px solid #2a3942;
}

.sidebar-header{
    padding:20px;
    background:#202c33;
    border-bottom:1px solid #2a3942;
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.sidebar-actions {
    display: flex;
    align-items: center;
    gap: 8px;
}

.sidebar-header h3{
    font-size:18px;
    font-weight:600;
    color:#f0f2f5;
}

.user-list{
    flex:1;
    overflow-y:auto;
}

.user{
    padding:12px 20px;
    border-bottom:1px solid #2a3942;
    cursor:pointer;
    display:flex;
    align-items:center;
    transition:background-color 0.2s;
}

.user:hover{
    background:#2a3942;
}

.user.active{
    background:#2a3942;
}

.user-avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    background:#25D366;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-right:12px;
    font-weight:600;
    font-size:16px;
    color:#111b21;
}

.user-avatar i {
    font-size: 18px;
    line-height: 1;
}

.user-info{
    flex:1;
}

.user-name{
    font-weight:500;
    font-size:16px;
    color:#f0f2f5;
    margin-bottom:2px;
}

.user-status{
    font-size:13px;
    color:#8696a0;
}

/* CHAT */
.chat{
    width:70%;
    display:flex;
    flex-direction:column;
    background:#0b141a;
}

.chat-header{
    background:#202c33;
    color:white;
    padding:16px 20px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    border-bottom:1px solid #2a3942;
    box-shadow:0 1px 2px rgba(0,0,0,0.1);
}

.chat-header-avatar {
    width:40px;
    height:40px;
    border-radius:50%;
    background:#25D366;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#111b21;
    font-weight:600;
    font-size:16px;
}

.chat-header-avatar i {
    font-size: 18px;
    line-height: 1;
}

.chat-info{
    display:flex;
    align-items:center;
}

.chat-avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    background:#25D366;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-right:12px;
    font-weight:600;
    font-size:16px;
    color:#111b21;
}

.chat-avatar i {
    font-size: 18px;
    line-height: 1;
}

.chat-name{
    font-weight:500;
    font-size:18px;
    color:#f0f2f5;
}

.chat-actions{
    display:flex;
    gap:15px;
}

.chat-action-btn{
    background:none;
    border:none;
    color:#8696a0;
    font-size:20px;
    cursor:pointer;
    padding:8px;
    border-radius:50%;
    transition:all 0.2s ease;
    position: relative;
    overflow: hidden;
}

.chat-action-btn:hover{
    color:#f0f2f5;
    background: rgba(255, 255, 255, 0.1);
    transform: scale(1.05);
}

.chat-action-btn:active {
    transform: scale(0.95);
}

.chat-action-btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    transform: translate(-50%, -50%);
    transition: width 0.3s, height 0.3s;
}

.chat-action-btn:hover::before {
    width: 100%;
    height: 100%;
}

.back{
    display:none;
    margin-right:10px;
    cursor:pointer;
    color:#f0f2f5;
    font-size:20px;
}

.messages{
    flex:1;
    padding:20px;
    overflow-y:auto;
    overflow-x:hidden;
    display:flex;
    flex-direction:column;
    gap:1px;
    box-sizing:border-box;
    height:100%;
}

.message-date{
    text-align:center;
    color:#8696a0;
    font-size:12px;
    margin:10px 0;
    padding:5px;
    background:rgba(32,44,51,0.5);
    border-radius:10px;
    align-self:center;
}

.msg{
    padding:8px 12px;
    border-radius:18px;
    margin:4px 0;
    max-width:75%;
    word-wrap:break-word;
    position:relative;
    box-shadow:0 1px 0.5px rgba(0,0,0,0.13);
    overflow: hidden;
    box-sizing: border-box;
}

.me{
    background:#005c4b;
    color:white;
    align-self:flex-end;
    border-bottom-right-radius:2px;
}

.other{
    background:#202c33;
    color:#f0f2f5;
    align-self:flex-start;
    border-bottom-left-radius:2px;
}

.msg-content{
    line-height:1.4;
    white-space:pre-wrap;
    word-wrap:break-word;
    word-break:break-word;
    overflow-wrap: break-word;
    max-width: 100%;
    box-sizing: border-box;
    display: block;
    color: inherit;
}

.msg-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    display: block;
    margin: 4px 0;
}

.msg-audio-container {
    display: flex;
    align-items: center;
    background: rgba(37, 211, 102, 0.1);
    border-radius: 8px;
    padding: 8px 12px;
    margin: 4px 0;
    cursor: pointer;
    transition: background 0.2s ease;
}

.msg-audio-container:hover {
    background: rgba(37, 211, 102, 0.2);
}

.msg-audio-player {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
}

.audio-icon {
    font-size: 24px;
    color: #25D366;
}

.audio-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.audio-name {
    font-size: 14px;
    font-weight: 500;
    color: #f0f2f5;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 150px;
}

.audio-size {
    font-size: 12px;
    color: #8696a0;
}

.audio-duration {
    font-size: 12px;
    color: #8696a0;
}

.audio-play-btn {
    font-size: 16px;
    color: #25D366;
    transition: transform 0.2s ease;
}

.msg-audio-container:hover .audio-play-btn {
    transform: scale(1.1);
}

.other .msg-audio-container {
    background: rgba(32, 44, 51, 0.1);
}

.other .audio-icon {
    color: #25D366;
}

.other .audio-name {
    color: #f0f2f5;
}

.other .audio-size,
.other .audio-duration {
    color: #8696a0;
}

.other .audio-play-btn {
    color: #25D366;
}

.msg-content * {
    max-width: 100%;
    box-sizing: border-box;
}

.msg-content:empty {
    display: none;
}

.msg-bubble {
    display: flex;
    flex-direction: column;
    max-width: 100%;
    position: relative;
}

.msg-bubble .msg-content {
    flex: 1;
}

.msg-bubble .msg-time {
    margin-top: 2px;
    align-self: flex-end;
}

.other .msg-bubble .msg-time {
    align-self: flex-start;
}

/* Mobile-specific msg-content styling */
@media (max-width: 768px) {
    .msg-content {
        font-size: 16px !important;
        line-height: 1.5 !important;
        padding: 8px 12px !important;
        margin: 0 !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
        overflow-wrap: break-word !important;
        hyphens: auto !important;
        -webkit-hyphens: auto !important;
        -ms-hyphens: auto !important;
        -moz-hyphens: auto !important;
        max-width: 100% !important;
        overflow: visible !important;
        box-sizing: border-box !important;
        white-space: pre-wrap !important;
        display: block !important;
        min-height: auto !important;
    }
    
    .msg {
        max-width: 85% !important;
        overflow: visible !important;
        box-sizing: border-box !important;
        min-height: auto !important;
        display: flex !important;
        flex-direction: row-reverse !important;
        align-items: flex-end !important;
        margin-bottom: 12px !important;
    }
    
    .msg.other {
        flex-direction: row !important;
    }
    
    .msg-bubble {
        max-width: 100% !important;
        overflow: visible !important;
        flex: 1 !important;
        min-width: 0 !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
    }
    
    .msg-bubble .msg-content {
        overflow: visible !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
        white-space: pre-wrap !important;
        width: 100% !important;
        min-width: 0 !important;
    }
    
    .msg-content img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 8px !important;
        display: block !important;
        margin: 4px 0 !important;
    }
    
    .msg-content * {
        max-width: 100% !important;
        box-sizing: border-box !important;
    }
    
    .msg-bubble {
        max-width: 100% !important;
        flex-direction: column !important;
    }
    
    .msg-bubble .msg-time {
        font-size: 10px !important;
        margin-top: 3px !important;
    }
    
    /* Handle links in message content */
    .msg-content a {
        color: #25D366 !important;
        text-decoration: underline !important;
        word-break: break-all !important;
    }
    
    /* Handle emojis in message content */
    .msg-content img.emoji {
        width: 20px !important;
        height: 20px !important;
        vertical-align: middle !important;
        margin: 0 2px !important;
    }
    
    /* Handle code blocks in message content */
    .msg-content code {
        background: rgba(0, 0, 0, 0.1) !important;
        padding: 2px 4px !important;
        border-radius: 4px !important;
        font-size: 14px !important;
        word-break: break-all !important;
    }
    
    /* Handle quoted text in message content */
    .msg-content blockquote {
        border-left: 3px solid #25D366 !important;
        padding-left: 12px !important;
        margin: 8px 0 !important;
        font-style: italic !important;
        color: #8696a0 !important;
    }
}

/* Extra small mobile devices */
@media (max-width: 480px) {
    .msg-content {
        font-size: 15px !important;
        line-height: 1.4 !important;
    }
    
    .msg-content code {
        font-size: 13px !important;
    }
}

/* Mobile msg-content overlay styling */
@media (max-width: 768px) {
    /* Base overlay container */
    .msg-content-overlay {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        background: rgba(0, 0, 0, 0.8) !important;
        z-index: 9999 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 20px !important;
        box-sizing: border-box !important;
        backdrop-filter: blur(5px) !important;
        -webkit-backdrop-filter: blur(5px) !important;
        animation: fadeInOverlay 0.3s ease-out !important;
    }
    
    /* Overlay content container */
    .msg-content-overlay .msg-content {
        background: #2a3942 !important;
        color: #f0f2f5 !important;
        padding: 20px !important;
        border-radius: 12px !important;
        max-width: 90vw !important;
        max-height: 70vh !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5) !important;
        border: 1px solid #3b4a54 !important;
        position: relative !important;
        font-size: 16px !important;
        line-height: 1.5 !important;
        word-wrap: break-word !important;
        animation: slideUpOverlay 0.3s ease-out !important;
    }
    
    /* Overlay close button */
    .msg-content-overlay .close-overlay {
        position: absolute !important;
        top: 10px !important;
        right: 10px !important;
        width: 30px !important;
        height: 30px !important;
        background: rgba(255, 255, 255, 0.1) !important;
        border: none !important;
        border-radius: 50% !important;
        color: #f0f2f5 !important;
        font-size: 18px !important;
        cursor: pointer !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.2s ease !important;
        z-index: 1 !important;
    }
    
    .msg-content-overlay .close-overlay:hover {
        background: rgba(255, 255, 255, 0.2) !important;
        transform: scale(1.1) !important;
    }
    
    .msg-content-overlay .close-overlay:active {
        transform: scale(0.95) !important;
    }
    
    /* Overlay header */
    .msg-content-overlay .overlay-header {
        border-bottom: 1px solid #3b4a54 !important;
        padding-bottom: 12px !important;
        margin-bottom: 12px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        color: #8696a0 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }
    
    /* Overlay timestamp */
    .msg-content-overlay .overlay-time {
        font-size: 12px !important;
        color: #8696a0 !important;
        margin-top: 12px !important;
        padding-top: 12px !important;
        border-top: 1px solid #3b4a54 !important;
        text-align: right !important;
    }
    
    /* Overlay for images */
    .msg-content-overlay .msg-content img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 8px !important;
        margin: 8px 0 !important;
    }
    
    /* Overlay for links */
    .msg-content-overlay .msg-content a {
        color: #25D366 !important;
        text-decoration: underline !important;
        word-break: break-all !important;
    }
    
    /* Overlay for code */
    .msg-content-overlay .msg-content code {
        background: rgba(0, 0, 0, 0.2) !important;
        padding: 3px 6px !important;
        border-radius: 4px !important;
        font-size: 14px !important;
        word-break: break-all !important;
    }
    
    /* Overlay for blockquotes */
    .msg-content-overlay .msg-content blockquote {
        border-left: 3px solid #25D366 !important;
        padding-left: 12px !important;
        margin: 12px 0 !important;
        font-style: italic !important;
        color: #8696a0 !important;
    }
}

/* Extra small mobile overlay adjustments */
@media (max-width: 480px) {
    .msg-content-overlay .msg-content {
        max-width: 95vw !important;
        padding: 16px !important;
        font-size: 15px !important;
    }
    
    .msg-content-overlay .close-overlay {
        width: 28px !important;
        height: 28px !important;
        font-size: 16px !important;
    }
}

/* Light mode overlay styling */
body.light-mode .msg-content-overlay {
    background: rgba(0, 0, 0, 0.6) !important;
}

body.light-mode .msg-content-overlay .msg-content {
    background: white !important;
    color: #111b21 !important;
    border-color: #e9edef !important;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2) !important;
}

body.light-mode .msg-content-overlay .close-overlay {
    background: rgba(0, 0, 0, 0.05) !important;
    color: #667781 !important;
}

body.light-mode .msg-content-overlay .close-overlay:hover {
    background: rgba(0, 0, 0, 0.1) !important;
}

body.light-mode .msg-content-overlay .overlay-header {
    border-color: #e9edef !important;
    color: #667781 !important;
}

body.light-mode .msg-content-overlay .overlay-time {
    border-color: #e9edef !important;
    color: #667781 !important;
}

body.light-mode .msg-content-overlay .msg-content a {
    color: #008069 !important;
}

body.light-mode .msg-content-overlay .msg-content code {
    background: rgba(0, 0, 0, 0.05) !important;
}

body.light-mode .msg-content-overlay .msg-content blockquote {
    border-left-color: #008069 !important;
    color: #667781 !important;
}

/* Overlay animations */
@keyframes fadeInOverlay {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideUpOverlay {
    from {
        opacity: 0;
        transform: translateY(20px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Message Image Styling */
.msg-image {
    max-width: 200px;
    max-height: 200px;
    min-width: 100px;
    min-height: 100px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    object-fit: cover;
    display: block;
    margin: 4px 0;
}

.msg-image:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.msg-image-container {
    position: relative;
    display: inline-block;
    margin: 4px 0;
}

.msg-image-loading {
    width: 200px;
    height: 200px;
    background: #34434e;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #8696a0;
    font-size: 12px;
}

.msg-image-loading::before {
    content: '';
    width: 20px;
    height: 20px;
    border: 2px solid #3b4a54;
    border-top: 2px solid #25D366;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-right: 8px;
}

/* Fullscreen Image Viewer */
.image-viewer {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.95);
    z-index: 10000;
    display: none;
    align-items: center;
    justify-content: center;
    animation: fadeInViewer 0.3s ease-out;
}

.image-viewer.show {
    display: flex;
}

.image-viewer-close {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    z-index: 10001;
}

.image-viewer-close:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

.image-viewer-close:active {
    transform: scale(0.95);
}

.image-viewer-content {
    max-width: 90vw;
    max-height: 90vh;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
    animation: zoomInViewer 0.3s ease-out;
}

.image-viewer-loading {
    width: 80px;
    height: 80px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-top: 3px solid #25D366;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

/* Mobile Image Viewer */
@media (max-width: 768px) {
    .msg-image {
        max-width: 150px;
        max-height: 150px;
        min-width: 80px;
        min-height: 80px;
    }
    
    .msg-image-loading {
        width: 150px;
        height: 150px;
    }
    
    .image-viewer-close {
        top: 15px;
        right: 15px;
        width: 36px;
        height: 36px;
        font-size: 20px;
    }
    
    .image-viewer-content {
        max-width: 95vw;
        max-height: 85vh;
    }
}

/* Light mode image styling */
body.light-mode .msg-image {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

body.light-mode .msg-image:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}

body.light-mode .msg-image-loading {
    background: #f0f2f5;
    color: #667781;
}

body.light-mode .msg-image-loading::before {
    border-color: #e9edef;
    border-top-color: #25D366;
}

body.light-mode .image-viewer {
    background: rgba(0, 0, 0, 0.9);
}

body.light-mode .image-viewer-close {
    background: rgba(0, 0, 0, 0.5);
    color: white;
}

body.light-mode .image-viewer-close:hover {
    background: rgba(0, 0, 0, 0.7);
}

/* Image Viewer Animations */
@keyframes fadeInViewer {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes zoomInViewer {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Light mode mobile styling */
body.light-mode .msg-content {
    color: #111b21 !important;
}

body.light-mode .msg-content a {
    color: #008069 !important;
}

body.light-mode .msg-content code {
    background: rgba(0, 0, 0, 0.05) !important;
}

body.light-mode .msg-content blockquote {
    border-left-color: #008069 !important;
    color: #667781 !important;
}

.msg img{
    border-radius:12px;
    max-width:200px;
    height:auto;
}

.msg-time{
    font-size:11px;
    color:rgba(255,255,255,0.7);
    margin-top:4px;
    display:flex;
    align-items:center;
    justify-content:flex-end;
    gap:4px;
    opacity:0.8;
    transition: opacity 0.2s ease;
}

.msg-time:hover {
    opacity: 1;
}

.other .msg-time{
    color:#8696a0;
    justify-content:flex-start;
}

.me .msg-time {
    color:rgba(255,255,255,0.6);
}

.other .msg-time {
    color:rgba(134,150,160,0.8);
}

.seen-ticks{
    font-size:14px;
    margin-left:2px;
}

.typing{
    color:#8696a0;
    font-size:13px;
    padding:8px 20px;
    font-style:italic;
    display:flex;
    align-items:center;
}

.typing-dots{
    display:inline-flex;
    gap:2px;
    margin-left:5px;
}

.typing-dot{
    width:4px;
    height:4px;
    border-radius:50%;
    background:#8696a0;
    animation:typing 1.4s infinite;
}

.typing-dot:nth-child(2){animation-delay:0.2s}
.typing-dot:nth-child(3){animation-delay:0.4s}

@keyframes typing{
    0%,60%,100%{transform:scale(1);opacity:1}
    30%{transform:scale(1.5);opacity:0.5}
}

.input-container{
    padding:20px;
    background:#202c33;
    border-top:1px solid #2a3942;
}

.input-box{
    display:flex;
    align-items:center;
    background:#2a3942;
    border-radius:30px;
    padding:8px 12px;
}

.input-box input{
    flex:1;
    padding:10px 15px;
    border:none;
    background:transparent;
    color:#f0f2f5;
    font-size:15px;
    outline:none;
}

.input-box input::placeholder{
    color:#8696a0;
}

.input-actions{
display:flex;
align-items:center;
gap:8px;
}

.input-btn{
background:none;
border:none;
color:#8696a0;
cursor:pointer;
font-size:20px;
padding:8px;
border-radius:50%;
transition:all 0.2s;
display:flex;
align-items:center;
justify-content:center;
}

.input-btn i {
    font-size: inherit;
    line-height: 1;
}


.input-btn:hover{
background: rgba(255, 255, 255, 0.1);
transform: scale(1.05);
    background:#3b4a54;
    color:#f0f2f5;
}

.send-btn{
    background:#25D366;
    color:white;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
}

.send-btn i {
    font-size: 16px;
    line-height: 1;
}

/* Attachment Popup Styles */
.attachment-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.attachment-popup-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

.attachment-popup-content {
    position: relative;
    background: #2a3942;
    border-radius: 15px;
    width: 90%;
    max-width: 400px;
    max-height: 80vh;
    overflow: hidden;
    animation: slideUp 0.3s ease-out;
}

@keyframes slideUp {
    from {
        transform: translateY(100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.attachment-popup-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    border-bottom: 1px solid #3b4a54;
}

.attachment-popup-header h3 {
    color: #f0f2f5;
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.attachment-popup-close {
    background: none;
    border: none;
    color: #8696a0;
    font-size: 24px;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s;
}

.attachment-popup-close:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #f0f2f5;
}

.attachment-popup-options {
    padding: 10px;
}

.attachment-option {
    display: flex;
    align-items: center;
    padding: 15px;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s;
    margin-bottom: 5px;
}

.attachment-option:hover {
    background: rgba(255, 255, 255, 0.05);
}

.attachment-option-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #25D366;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
}

.attachment-option-icon i {
    font-size: 20px;
    color: white;
}

.attachment-option-text {
    flex: 1;
}

.attachment-option-title {
    color: #f0f2f5;
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 2px;
}

.attachment-option-desc {
    color: #8696a0;
    font-size: 14px;
}

.send-btn:hover{
    background:#128c7e;
}

.input-box input[type="file"]{
    display:none;
}

/* DESKTOP SPECIFIC */
@media(min-width:769px){
    .sidebar{
        border-right:1px solid #2a3942;
    }
    
    .chat{
        border-left:1px solid #2a3942;
    }
    
    .messages{
        background-color:#0b141a;
        padding:15px !important;
        overflow-y:auto !important;
        overflow-x:visible !important;
        box-sizing:border-box !important;
        height:100% !important;
        width:100% !important;
        display:flex !important;
        flex-direction:column !important;
    }
}

/* MOBILE BOTTOM NAVIGATION */
.mobile-bottom-nav{
    display:none;
    position:fixed;
    bottom:0;
    left:0;
    right:0;
    background:#202c33;
    border-top:1px solid #2a3942;
    padding:8px 0;
    z-index:100;
}

.nav-item{
    flex:1;
    text-align:center;
    color:#8696a0;
    text-decoration:none;
    padding:8px;
    transition:color 0.2s;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:4px;
}

.nav-item.active{
    color:#25D366;
}

.nav-item:hover{
    color:#f0f2f5;
}

.nav-icon{
    font-size:20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-icon i {
    font-size: inherit;
    line-height: 1;
}

.nav-label{
    font-size:11px;
    font-weight:500;
}

.nav-badge{
    position:absolute;
    top:4px;
    right:20%;
    background:#ff3b30;
    color:white;
    font-size:10px;
    font-weight:600;
    padding:2px 5px;
    border-radius:10px;
    min-width:16px;
    text-align:center;
    line-height:1;
}

/* PROFILE EDIT POPUP */
.profile-popup{
    display:none;
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background:rgba(0,0,0,0.5);
    z-index:1000;
    animation:fadeIn 0.3s;
}

.profile-popup-content{
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    background:#202c33;
    border-radius:15px;
    padding:25px;
    width:90%;
    max-width:400px;
    max-height:80vh;
    overflow-y:auto;
    animation:slideUp 0.3s;
}

.profile-popup-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    padding-bottom:15px;
    border-bottom:1px solid #2a3942;
}

.profile-popup-title{
    color:#f0f2f5;
    font-size:18px;
    font-weight:600;
}

.profile-popup-close{
    background:none;
    border:none;
    color:#8696a0;
    font-size:24px;
    cursor:pointer;
    padding:0;
    width:30px;
    height:30px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    transition:background 0.2s;
}

.profile-popup-close:hover{
    background:#2a3942;
}

.profile-form-group{
    margin-bottom:20px;
}

.profile-form-label{
    display:block;
    color:#8696a0;
    font-size:12px;
    margin-bottom:8px;
    text-transform:uppercase;
    font-weight:600;
}

.profile-form-input{
    width:100%;
    background:#111b21;
    border:1px solid #2a3942;
    border-radius:8px;
    padding:12px;
    color:#f0f2f5;
    font-size:14px;
    transition:border-color 0.2s;
}

.profile-form-input:focus{
    outline:none;
    border-color:#25D366;
}

.profile-form-textarea{
    resize:vertical;
    min-height:80px;
    font-family:inherit;
}

.profile-popup-buttons{
    display:flex;
    gap:10px;
    margin-top:25px;
    padding-top:20px;
    border-top:1px solid #2a3942;
}

.profile-popup-btn{
    flex:1;
    padding:12px;
    border:none;
    border-radius:8px;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
    transition:background 0.2s;
}

.profile-popup-btn-primary {
    background: #25D366;
    color: white;
    border: none;
}

.profile-popup-btn-primary:hover{
    background:#128C7E;
}

.profile-popup-btn-danger {
    background: #dc3545;
    color: white;
    border: none;
}

.profile-popup-btn-danger:hover {
    background: #c82333;
}

.profile-popup-btn-secondary{
    background:#2a3942;
    color:#8696a0;
}

.profile-popup-btn-secondary:hover{
    background:#3a4a52;
}

/* ANIMATIONS */
@keyframes fadeIn{
    from{opacity:0;}
    to{opacity:1;}
}

@keyframes slideUp{
    from{
        transform:translate(-50%, -40%);
        opacity:0;
    }
    to{
        transform:translate(-50%, -50%);
        opacity:1;
    }
}

@keyframes spin{
    from{transform:rotate(0deg);}
    to{transform:rotate(360deg);}
}

/* MOBILE MODE */
@media(max-width:768px){
    body{
        display:block;
        padding-bottom:60px; /* Space for bottom nav */
    }

    .sidebar{
        width:100%;
        height:100vh;
        border-right:none;
    }

    .chat{
        position:fixed;
        top:0;
        left:100%;
        width:100%;
        height:100%;
        transition:0.3s;
        z-index:10;
        border-left:none;
    }

    .chat.active{
        left:0;
    }

    .back{
        display:block;
    }
    
    .chat-actions{
        display:none;
    }
    
    .mobile-bottom-nav{
        display:flex;
    }
    
    /* Hide bottom nav only when in actual chat (not Updates/Profile) */
    .chat.active:not(.updates-screen):not(.profile-screen) ~ .mobile-bottom-nav,
    .mobile-bottom-nav.hide{
        display:none;
    }
    
    /* Adjust sidebar height for mobile */
    .sidebar{
        height:calc(100vh - 60px);
    }
}

/* SCROLLBAR STYLING */
::-webkit-scrollbar{
    width:6px;
}

::-webkit-scrollbar-track{
    background:transparent;
}

::-webkit-scrollbar-thumb{
    background:#2a3942;
    border-radius:3px;
}

::-webkit-scrollbar-thumb:hover{
    background:#3b4a54;
}

/* Message reply styles */
.msg-reply {
    background: rgba(37, 211, 102, 0.1);
    border-left: 3px solid #25D366;
    border-radius: 8px;
    padding: 8px 12px;
    margin-bottom: 8px;
    cursor: pointer;
    transition: background 0.2s;
    position: relative;
    -webkit-tap-highlight-color: transparent;
}

.msg-reply:hover {
    background: rgba(37, 211, 102, 0.2);
}

.msg-reply:active {
    background: rgba(37, 211, 102, 0.3);
    transform: scale(0.98);
}

.reply-line {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: #25D366;
}

.reply-content {
    margin-left: 8px;
}

.reply-text {
    color: #8696a0;
    font-size: 13px;
    font-style: italic;
    line-height: 1.3;
}

/* Reply input styles */
.reply-input-container {
    background: #202c33;
    border-radius: 20px;
    padding: 8px 15px;
    margin-bottom: 10px;
    display: none;
    align-items: center;
    gap: 10px;
}

.reply-input-container.active {
    display: flex;
}

.reply-input {
    flex: 1;
    background: transparent;
    border: none;
    color: #f0f2f5;
    padding: 8px;
    font-size: 14px;
    outline: none;
}

.reply-input::placeholder {
    color: #8696a0;
}

.reply-cancel {
    background: none;
    border: none;
    color: #8696a0;
    cursor: pointer;
    font-size: 18px;
    padding: 5px;
    min-width: 30px;
    min-height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    -webkit-tap-highlight-color: transparent;
}

.reply-cancel:hover {
    color: #f0f2f5;
}

.reply-cancel:active {
    background: rgba(255, 255, 255, 0.1);
    transform: scale(0.9);
}

/* Message highlight for scrolling */
.msg.highlight {
    background: rgba(37, 211, 102, 0.2);
    border-radius: 8px;
    animation: highlightPulse 2s ease-in-out;
}

@keyframes highlightPulse {
    0% { background: rgba(37, 211, 102, 0.4); }
    50% { background: rgba(37, 211, 102, 0.2); }
    100% { background: transparent; }
}

@keyframes fadeOut {
    from { opacity: 1; transform: scale(1); }
    to { opacity: 0; transform: scale(0.9); }
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(100%); }
    to { opacity: 1; transform: translateX(0); }
}

/* Modern CSS Improvements */
.chat-header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.chat-header-info {
    flex: 1;
    min-width: 0;
}

.chat-header-name {
    font-weight: 600;
    font-size: 18px;
    color: #f0f2f5;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.chat-header-status {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.7);

    .chat-header-right {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .chat-header-right.msg {
        display: flex;
        align-items: flex-end;
        margin-bottom: 12px;
        max-width: 75%;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .msg.me {
        align-self: flex-end;
        flex-direction: row-reverse;
    }
    padding: 12px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    border-top: 1px solid #2a3942;
}

.input-box {
    display: flex;
    align-items: center;
    gap: 8px;
    flex: 1;
}

.input-left-actions {
    display: flex;
    align-items: center;
    gap: 4px;
}

.input-field {
    flex: 1;
    background: #2a3942;
    color: #f0f2f5;
    border: 1px solid #3b4a54;
    border-radius: 20px;
    padding: 8px 16px;
    font-size: 15px;
    outline: none;
    transition: all 0.2s ease;
}

.input-field:focus {
    border-color: #25D366;
    background: #34434e;
}

.input-field::placeholder {
    color: #8696a0;
}

/* Emoji Picker Styling */
.emoji-picker {
    position: absolute;
    bottom: 80px;
    left: 20px;
    background: #2a3942;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
    width: 320px;
    max-height: 400px;
    z-index: 1000;
    display: none;
    border: 1px solid #3b4a54;
    animation: slideUpEmoji 0.3s ease-out;
}

.emoji-picker.show {
    display: block;
}

.emoji-picker-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    border-bottom: 1px solid #3b4a54;
}

.emoji-picker-tabs {
    display: flex;
    gap: 4px;
    flex: 1;
}

.emoji-tab {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 8px 12px;
    background: transparent;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    min-width: 60px;
    gap: 4px;
}

.emoji-tab:hover {
    background: rgba(255, 255, 255, 0.1);
}

.emoji-tab.active {
    background: rgba(37, 211, 102, 0.2);
    color: #25D366;
}

.emoji-tab-icon {
    font-size: 18px;
    line-height: 1;
}

.emoji-tab-label {
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 2px;
}

.emoji-picker-close {
    background: none;
    border: none;
    color: #8696a0;
    font-size: 20px;
    cursor: pointer;
    padding: 4px;
    border-radius: 50%;
    transition: all 0.2s ease;
}

.emoji-picker-close:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #f0f2f5;
}

/* Tab Content */
.emoji-tab-content {
    display: none;
    max-height: 350px;
    overflow-y: auto;
}

.emoji-tab-content.active {
    display: block;
}

/* GIF Tab Styles */
.gif-search-container {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    border-bottom: 1px solid #3b4a54;
}

.gif-search-input {
    flex: 1;
    background: #34434e;
    color: #f0f2f5;
    border: 1px solid #3b4a54;
    border-radius: 20px;
    padding: 8px 16px;
    font-size: 14px;
    outline: none;
    transition: all 0.2s ease;
}

.gif-search-input:focus {
    border-color: #25D366;
    background: #3b4a54;
}

.gif-search-input::placeholder {
    color: #8696a0;
}

.gif-search-btn {
    background: #25D366;
    color: white;
    border: none;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 16px;
}

.gif-search-btn:hover {
    background: #128c7e;
    transform: scale(1.05);
}

.gif-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    padding: 16px;
}

.gif-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.2s ease;
    background: #34434e;
    aspect-ratio: 1;
}

.gif-item:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.gif-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.gif-loading {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px;
    color: #8696a0;
    font-size: 14px;
}

.loading-spinner {
    width: 24px;
    height: 24px;
    border: 2px solid #3b4a54;
    border-top: 2px solid #25D366;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 8px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Sticker Tab Styles */
.sticker-categories {
    padding: 16px;
}

.sticker-category {
    margin-bottom: 20px;
}

.sticker-category:last-child {
    margin-bottom: 0;
}

.sticker-category-title {
    color: #8696a0;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
}

.sticker-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
}

.sticker-item {
    aspect-ratio: 1;
    background: #34434e;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    border: 2px solid transparent;
}

.sticker-item:hover {
    transform: scale(1.05);
    border-color: #25D366;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.sticker-emoji {
    font-size: 32px;
    line-height: 1;
}

.emoji-picker-content {
    max-height: 350px;
    overflow-y: auto;
}

.emoji-category {
    margin-bottom: 12px;
}

.emoji-category:last-child {
    margin-bottom: 0;
}

.emoji-category-title {
    color: #8696a0;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 8px 16px 4px;
}

.emoji-grid {
    display: flex;
    flex-direction: row;
    gap: 4px;
    padding: 0 16px 8px;
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
}

.emoji-grid::-webkit-scrollbar {
    height: 4px;
}

.emoji-grid::-webkit-scrollbar-track {
    background: #2a3942;
    border-radius: 2px;
}

.emoji-grid::-webkit-scrollbar-thumb {
    background: #3b4a54;
    border-radius: 2px;
}

.emoji-grid::-webkit-scrollbar-thumb:hover {
    background: #4a5963;
}

.emoji-item {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 20px;
    transition: all 0.2s ease;
    background: transparent;
}

.emoji-item:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: scale(1.2);
}

.emoji-item:active {
    transform: scale(0.95);
}

/* Mobile Emoji Picker */
@media (max-width: 768px) {
    .emoji-picker {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        width: auto;
        border-radius: 20px 20px 0 0;
        max-height: 60vh;
        animation: slideUpMobile 0.3s ease-out;
    }
    
    .emoji-picker-tabs {
        gap: 2px;
        padding: 0 8px;
    }
    
    .emoji-tab {
        padding: 6px 8px;
        min-width: 50px;
    }
    
    .emoji-tab-icon {
        font-size: 16px;
    }
    
    .emoji-tab-label {
        font-size: 10px;
        margin-top: 1px;
    }
    
    .emoji-grid {
        gap: 6px;
        padding: 0 16px 16px;
    }
    
    .emoji-item {
        width: 36px;
        height: 36px;
        font-size: 22px;
    }
    
    .gif-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 6px;
        padding: 12px;
    }
    
    .gif-search-container {
        padding: 8px 16px;
        gap: 6px;
    }
    
    .gif-search-input {
        font-size: 16px; /* Prevents zoom on iOS */
        padding: 10px 14px;
    }
    
    .gif-search-btn {
        width: 32px;
        height: 32px;
        font-size: 14px;
    }
    
    .sticker-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }
    
    .sticker-categories {
        padding: 12px;
    }
    
    .sticker-category {
        margin-bottom: 16px;
    }
    
    .sticker-emoji {
        font-size: 28px;
    }
    
    .input-box {
        gap: 6px;
    }
    
    .emoji-btn {
        font-size: 18px !important;
        padding: 6px !important;
    }
}

/* Extra small mobile */
@media (max-width: 480px) {
    .emoji-picker {
        max-height: 50vh;
    }
    
    .emoji-grid {
        grid-template-columns: repeat(7, 1fr);
        gap: 6px;
    }
    
    .emoji-item {
        width: 32px;
        height: 32px;
        font-size: 18px;
    }
}

/* Light Mode Emoji Picker */
body.light-mode .emoji-picker {
    background: white;
    border-color: #e9edef;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
}

body.light-mode .emoji-picker-header {
    border-color: #e9edef;
}

body.light-mode .emoji-picker-title {
    color: #111b21;
}

body.light-mode .emoji-picker-close {
    color: #667781;
}

body.light-mode .emoji-picker-close:hover {
    background: rgba(0, 0, 0, 0.05);
    color: #111b21;
}

body.light-mode .emoji-category-title {
    color: #667781;
}

body.light-mode .emoji-item:hover {
    background: rgba(0, 0, 0, 0.05);
}

body.light-mode .emoji-grid::-webkit-scrollbar-track {
    background: #f0f2f5;
}

body.light-mode .emoji-grid::-webkit-scrollbar-thumb {
    background: #e9edef;
}

body.light-mode .emoji-grid::-webkit-scrollbar-thumb:hover {
    background: #d1d5db;
}

/* Emoji Picker Animations */
@keyframes slideUpEmoji {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideUpMobile {
    from {
        opacity: 0;
        transform: translateY(100%);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Enhanced Button Styling */
.send-btn {
    background: #25D366;
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 18px;
}

.send-btn:hover {
    background: #128c7e;
    transform: scale(1.05);
}

.send-btn:active {
    transform: scale(0.95);
}

/* Enhanced User Styling */
.user {
    padding: 12px 20px;
    border-bottom: 1px solid #2a3942;
    cursor: pointer;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
    position: relative;
}

.user:hover {
    background: #2a3942;
}

.user.active {
    background: #2a3942;
}

.user.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: #25D366;
}

/* Enhanced Avatar Styling */
.user-avatar,
.chat-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #25D366;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #111b21;
    font-weight: 600;
    font-size: 16px;
    margin-right: 12px;
    flex-shrink: 0;
}

/* Enhanced Mobile Responsiveness */
@media (max-width: 768px) {
    .chat-header-name {
        font-size: 16px;
    }
    
    .chat-header-status {
        font-size: 12px;
    }
    
    .chat-action-btn {
        font-size: 18px;
        padding: 6px;
    }
    
    .input-container {
        padding: 10px 16px;
    }
    
    .input-field {
        font-size: 16px; /* Prevents zoom on iOS */
    }
}

/* Mobile-specific reply styles */
@media (max-width: 768px) {
    .msg-reply {
        padding: 12px 16px;
        margin-bottom: 10px;
        border-radius: 12px;
        min-height: 44px; /* Minimum touch target size */
        display: flex;
        align-items: center;
    }
    
    .reply-text {
        font-size: 14px;
        line-height: 1.4;
    }
    
    .reply-input-container {
        padding: 12px 20px;
        margin-bottom: 15px;
        border-radius: 25px;
        min-height: 50px;
    }
    
    .reply-input {
        font-size: 16px; /* Prevent zoom on iOS */
        padding: 12px;
    }
    
    .reply-cancel {
        font-size: 20px;
        min-width: 40px;
        min-height: 40px;
        padding: 8px;
    }
    
    /* Enhanced mobile message touch targets */
    .msg {
        min-height: 44px; /* Minimum touch target */
        padding: 8px 0;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
    }
    
    .msg:active {
        background: rgba(37, 211, 102, 0.05);
        transform: scale(0.99);
    }
    
    /* Mobile scroll animation */
    .msg.highlight {
        animation: mobileHighlightPulse 2.5s ease-in-out;
    }
    
    @keyframes mobileHighlightPulse {
        0% { 
            background: rgba(37, 211, 102, 0.4);
            transform: scale(1.02);
        }
        25% { 
            background: rgba(37, 211, 102, 0.3);
            transform: scale(1.01);
        }
        50% { 
            background: rgba(37, 211, 102, 0.2);
            transform: scale(1);
        }
        100% { 
            background: transparent;
            transform: scale(1);
        }
    }
    
    /* Mobile reply preview enhancement */
    .msg-reply::before {
        content: '';
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 6px solid #25D366;
        border-top: 4px solid transparent;
        border-bottom: 4px solid transparent;
        opacity: 0.6;
    }
}

/* Extra small mobile devices */
@media (max-width: 480px) {
    .msg-reply {
        padding: 10px 14px;
        margin-bottom: 8px;
    }
    
    .reply-text {
        font-size: 13px;
    }
    
    .reply-input-container {
        padding: 10px 16px;
        margin-bottom: 12px;
    }
}

/* Desktop Context Menu Styles */
.context-menu {
    position: fixed;
    background: #2a3942;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    padding: 8px 0;
    min-width: 180px;
    z-index: 10000;
    display: none;
    border: 1px solid #3b4a54;
}

/* Mobile Context Menu Styles */
@media (max-width: 768px) {
    .context-menu {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: auto;
        border-radius: 20px 20px 0 0;
        min-width: auto;
        max-height: 50vh;
        overflow-y: auto;
        animation: slideUpMenu 0.3s ease-out;
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.3);
    }
    
    .context-menu-item {
        padding: 16px 20px;
        font-size: 16px;
        border-bottom: 1px solid #3b4a54;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .context-menu-item:last-child {
        border-bottom: none;
    }
    
    .context-menu-item span:first-child {
        font-size: 20px;
    }
    
    .context-menu-item span:last-child {
        color: #8696a0;
        font-size: 14px;
    }
    
    .context-menu-separator {
        display: none;
    }
    
    /* Mobile selection header */
    .selection-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 10001;
        border-radius: 0;
        border-bottom: 1px solid #2a3942;
    }
    
    .selection-info {
        font-size: 16px;
    }
    
    .selection-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .selection-btn {
        padding: 8px 12px;
        font-size: 14px;
        min-width: 60px;
    }
    
    /* Mobile message checkboxes */
    .message-checkbox {
        top: 12px;
        left: 12px;
        width: 24px;
        height: 24px;
        border-width: 3px;
    }
    
    .message-checkbox .checkmark {
        width: 14px;
        height: 14px;
    }
    
    .msg.selection-mode {
        padding-left: 50px;
        min-height: 60px;
        display: flex;
        align-items: center;
    }
    
    /* Mobile forward dialog */
    .forward-dialog {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: auto;
        transform: none;
        border-radius: 20px 20px 0 0;
        min-width: auto;
        max-width: none;
        max-height: 80vh;
        animation: slideUpMenu 0.3s ease-out;
    }
    
    .forward-user-list {
        max-height: 40vh;
    }
    
    .forward-user-item {
        padding: 16px;
        min-height: 60px;
    }
    
    .forward-user-avatar {
        width: 44px;
        height: 44px;
        font-size: 18px;
    }
    
    .forward-user-name {
        font-size: 16px;
    }
}

@keyframes slideUpMenu {
    from {
        transform: translateY(100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Mobile touch feedback */
@media (max-width: 768px) {
    .context-menu-item:active {
        background: #3b4a54;
        transform: scale(0.98);
    }
    
    .msg:active {
        background: rgba(37, 211, 102, 0.1);
        transform: scale(0.99);
    }
    
    .selection-btn:active {
        transform: scale(0.95);
    }
    
    .forward-user-item:active {
        transform: scale(0.98);
    }
}

.context-menu-item {
    padding: 10px 20px;
    color: #f0f2f5;
    cursor: pointer;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: background 0.2s;
}

.context-menu-item:hover {
    background: #3b4a54;
}

.context-menu-item.danger {
    color: #ff4757;
}

.context-menu-item.danger:hover {
    background: rgba(255, 71, 87, 0.1);
}

.context-menu-item.warning {
    color: #ffa502;
}

.context-menu-item.warning:hover {
    background: rgba(255, 165, 2, 0.1);
}

.context-menu-separator {
    height: 1px;
    background: #3b4a54;
    margin: 4px 0;
}

/* Message Selection Styles */
.message-checkbox {
    position: absolute;
    top: 8px;
    left: 8px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid #25D366;
    background: #111b21;
    cursor: pointer;
    display: none;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.message-checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.message-checkbox .checkmark {
    width: 12px;
    height: 12px;
    background: #25D366;
    border-radius: 50%;
    display: none;
}

.message-checkbox input:checked ~ .checkmark {
    display: block;
}

.msg.selection-mode {
    position: relative;
    padding-left: 40px;
}

.msg.selection-mode .message-checkbox {
    display: flex;
}

.msg.selected {
    background: rgba(37, 211, 102, 0.1);
    border-radius: 8px;
}

/* Selection Header */
.selection-header {
    background: #202c33;
    padding: 12px 20px;
    display: none;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #2a3942;
}

.selection-header.active {
    display: flex;
}

.selection-info {
    color: #f0f2f5;
    font-size: 14px;
}

.selection-actions {
    display: flex;
    gap: 10px;
}

.selection-btn {
    background: #25D366;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
    transition: background 0.2s;
}

.selection-btn:hover {
    background: #128c7e;
}

.selection-btn.danger {
    background: #dc3545;
}

.selection-btn.danger:hover {
    background: #c82333;
}

/* Desktop-specific enhancements */
@media (min-width: 769px) {
    .msg {
        position: relative;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    
    .msg:hover {
        background: rgba(37, 211, 102, 0.05);
        border-radius: 8px;
    }
    
    .msg.selection-mode:hover {
        background: rgba(37, 211, 102, 0.1);
    }
}

/* Chat Header Dropdowns */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: #2a3942;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    min-width: 180px;
    z-index: 1000;
    display: none;
    border: 1px solid #3b4a54;
    overflow: hidden;
    margin-top: 5px;
}

.dropdown-menu.show {
    display: block;
    animation: dropdownSlide 0.2s ease-out;
}

@keyframes dropdownSlide {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-item {
    padding: 12px 16px;
    color: #f0f2f5;
    cursor: pointer;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: background 0.2s;
    border-bottom: 1px solid #3b4a54;
}

.dropdown-item:last-child {
    border-bottom: none;
}

.dropdown-item:hover {
    background: #3b4a54;
}

.dropdown-item span:first-child {
    font-size: 16px;
    width: 20px;
    text-align: center;
}

.dropdown-separator {
    height: 1px;
    background: #3b4a54;
    margin: 4px 16px;
}

.dropdown-item.logout {
    color: #ff6b6b;
    font-weight: 500;
}

.dropdown-item.logout:hover {
    background: rgba(255, 107, 107, 0.1);
}

body.light-mode .dropdown-separator {
    background: #e9edef;
}

body.light-mode .dropdown-item.logout {
    color: #dc3545;
}

body.light-mode .dropdown-item.logout:hover {
    background: rgba(220, 53, 69, 0.1);
}

/* Light Mode Styles */
body.light-mode {
    background: #f0f2f5;
    color: #111b21;
}

body.light-mode .sidebar {
    background: #f0f2f5;
    border-right: 1px solid #e9edef;
}

body.light-mode .sidebar-header {
    background: #008069;
    color: white;
}

body.light-mode .user {
    background: white;
    border-bottom: 1px solid #e9edef;
}

body.light-mode .user:hover {
    background: #f5f6f6;
}

body.light-mode .user-avatar {
    background: #008069;
    color: white;
}

body.light-mode .user-name {
    color: #111b21;
}

body.light-mode .user-message {
    color: #667781;
}

body.light-mode .user-time {
    color: #667781;
}

body.light-mode .chat {
    background: #f0f2f5;
}

body.light-mode .chat-header {
    background: #008069;
    color: white;
}

body.light-mode .chat-header-name {
    color: white;
}

body.light-mode .chat-header-status {
    color: rgba(255, 255, 255, 0.8);
}

body.light-mode .messages {
    background: #e5ddd5;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8cmVjdCB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iI2U1ZGRkNSIvPgogIDxwYXRoIGQ9Ik0wIDUwIEwxMDAgNTAiIHN0cm9rZT0iI2RkZGRkZCIgc3Ryb2tlLXdpZHRoPSIwLjUiLz4KICA8cGF0aCBkPSJNMCAwIEwxMDAgMTAwIiBzdHJva2U9IiNkZGRkZGQiIHN0cm9rZS13aWR0aD0iMC41Ii8+Cjwvc3ZnPg==');
}

body.light-mode .msg.me .msg-bubble {
    background: #dcf8c6;
    color: #111b21;
}

body.light-mode .msg.other .msg-bubble {
    background: white;
    color: #111b21;
}

body.light-mode .input-container {
    background: #f0f2f5;
    border-top: 1px solid #e9edef;
}

body.light-mode .input-field {
    background: white;
    color: #111b21;
    border: 1px solid #e9edef;
}

body.light-mode .input-field::placeholder {
    color: #8696a0;
}

body.light-mode .send-btn {
    background: #008069;
}

body.light-mode .send-btn:hover {
    background: #006954;
}

body.light-mode .dropdown-menu {
    background: white;
    border: 1px solid #e9edef;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

body.light-mode .dropdown-item {
    color: #111b21;
    border-bottom: 1px solid #e9edef;
}

body.light-mode .dropdown-item:hover {
    background: #f5f6f6;
}

body.light-mode .context-menu {
    background: white;
    border: 1px solid #e9edef;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

body.light-mode .context-menu-item {
    color: #111b21;
    border-bottom: 1px solid #e9edef;
}

body.light-mode .context-menu-item:hover {
    background: #f5f6f6;
}

body.light-mode .selection-header {
    background: #008069;
    border-bottom: 1px solid #006954;
}

body.light-mode .selection-info {
    color: white;
}

body.light-mode .profile-popup-content {
    background: white;
    color: #111b21;
}

body.light-mode .profile-popup-title {
    color: #111b21;
}

body.light-mode .profile-popup-close {
    color: #667781;
}

body.light-mode .profile-popup-close:hover {
    background: #f5f6f6;
    color: #111b21;
}

body.light-mode .profile-popup-btn-secondary {
    background: #f5f6f6;
    color: #111b21;
    border: 1px solid #e9edef;
}

body.light-mode .profile-popup-btn-secondary:hover {
    background: #e9edef;
}

body.light-mode .profile-popup-btn-primary {
    background: #008069;
    color: white;
}

body.light-mode .profile-popup-btn-primary:hover {
    background: #006954;
}

body.light-mode .profile-popup-btn-danger {
    background: #dc3545;
    color: white;
}

body.light-mode .profile-popup-btn-danger:hover {
    background: #c82333;
}

/* Forward Dialog */
.forward-dialog {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #2a3942;
    border-radius: 12px;
    padding: 20px;
    min-width: 400px;
    max-width: 500px;
    max-height: 80vh;
    overflow-y: auto;
    z-index: 10001;
    display: none;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
}

.forward-dialog-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #3b4a54;
}

.forward-dialog-title {
    color: #f0f2f5;
    font-size: 18px;
    font-weight: 600;
}

.forward-dialog-close {
    background: none;
    border: none;
    color: #8696a0;
    font-size: 24px;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.2s;
}

.forward-dialog-close:hover {
    background: rgba(255, 255, 255, 0.1);
}

.forward-user-list {
    max-height: 300px;
    overflow-y: auto;
}

.forward-user-item {
    display: flex;
    align-items: center;
    padding: 12px;
    cursor: pointer;
    border-radius: 8px;
    transition: background 0.2s;
}

.forward-user-item:hover {
    background: #3b4a54;
}

.forward-user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #25D366;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #111b21;
    font-weight: 600;
    margin-right: 12px;
}

.forward-user-name {
    color: #f0f2f5;
    font-size: 14px;
}

.forward-actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
    padding-top: 15px;
    border-top: 1px solid #3b4a54;
}

.forward-btn {
    flex: 1;
    padding: 10px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.2s;
}

.forward-btn.primary {
    background: #25D366;
    color: white;
}

.forward-btn.primary:hover {
    background: #128c7e;
}

.forward-btn.secondary {
    background: #3b4a54;
    color: #f0f2f5;
}

.forward-btn.secondary:hover {
    background: #4a5564;
}
</style>
</head>

<body>

<!-- AUDIO NOTIFICATION -->
<audio id="tone" src="https://actions.google.com/sounds/v1/alarms/beep_short.ogg"></audio>

<!-- CONTEXT MENU -->
<div id="contextMenu" class="context-menu">
    <div class="context-menu-item" onclick="contextMenuReply()">
        <span>💬</span>
        <span>Reply</span>
    </div>
    <div class="context-menu-item" onclick="contextMenuForward()">
        <span>📤</span>
        <span>Forward</span>
    </div>
    <div class="context-menu-item" onclick="contextMenuCopy()">
        <span>📋</span>
        <span>Copy</span>
    </div>
    <div class="context-menu-item" onclick="contextMenuEdit()">
        <span>✏️</span>
        <span>Edit</span>
    </div>
    <div class="context-menu-separator"></div>
    <div class="context-menu-item" onclick="contextMenuSelect()">
        <span>☑️</span>
        <span>Select</span>
    </div>
    <div class="context-menu-item danger" onclick="contextMenuDelete()">
        <span>🗑️</span>
        <span>Delete</span>
    </div>
    <div class="context-menu-separator"></div>
    <div class="context-menu-item warning" onclick="contextMenuClearChat()">
        <span>🧹</span>
        <span>Clear Chat</span>
    </div>
</div>

<!-- SELECTION HEADER -->
<div id="selectionHeader" class="selection-header">
    <div class="selection-info">
        <span id="selectedCount">0</span> selected
    </div>
    <div class="selection-actions">
        <button class="selection-btn" onclick="bulkReply()">Reply</button>
        <button class="selection-btn" onclick="bulkForward()">Forward</button>
        <button class="selection-btn" onclick="bulkCopy()">Copy</button>
        <button class="selection-btn danger" onclick="bulkDelete()">Delete</button>
        <button class="selection-btn" onclick="exitSelectionMode()">Cancel</button>
    </div>
</div>

<!-- FORWARD DIALOG -->
<div id="forwardDialog" class="forward-dialog">
    <div class="forward-dialog-header">
        <div class="forward-dialog-title">Forward Messages</div>
        <button class="forward-dialog-close" onclick="closeForwardDialog()">×</button>
    </div>
    <div class="forward-user-list">
        <!-- User list will be populated by JavaScript -->
    </div>
    <div class="forward-actions">
        <button class="forward-btn secondary" onclick="closeForwardDialog()">Cancel</button>
        <button class="forward-btn primary" onclick="confirmForward()">Forward</button>
    </div>
</div>

<!-- DELETE CONFIRMATION POPUP -->
<div id="deletePopup" class="profile-popup">
    <div class="profile-popup-content" style="max-width:400px;">
        <div class="profile-popup-header">
            <div class="profile-popup-title">Delete Messages</div>
            <button class="profile-popup-close" onclick="closeDeletePopup()">×</button>
        </div>
        
        <div style="padding:20px 0;">
            <div style="text-align:center;margin-bottom:25px;">
                <div style="width:80px;height:80px;border-radius:50%;background:#dc3545;display:flex;align-items:center;justify-content:center;margin:0 auto 15px;border:3px solid #111b21;">
                    <span style="color:#111b21;font-size:32px;">🗑️</span>
                </div>
                <h3 style="color:#f0f2f5;margin-bottom:5px;">Delete Messages</h3>
                <p style="color:#8696a0;font-size:13px;" id="deleteMessageText">This action cannot be undone.</p>
            </div>
            
            <div style="background:#202c33;border-radius:10px;padding:15px;margin-bottom:20px;">
                <div style="color:#dc3545;font-size:12px;margin-bottom:8px;">⚠️ Warning</div>
                <div style="color:#f0f2f5;font-size:14px;line-height:1.4;" id="deleteWarningText">
                    Are you sure you want to delete this message? It will be permanently removed.
                </div>
            </div>
            
            <div class="profile-popup-buttons">
                <button type="button" class="profile-popup-btn profile-popup-btn-secondary" onclick="closeDeletePopup()">Cancel</button>
                <button type="button" class="profile-popup-btn profile-popup-btn-danger" onclick="confirmDelete()" style="background:#dc3545;">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3>Support Chat</h3>
        <div class="sidebar-actions">
            <div class="chat-action-btn">🔍</div>
            <div class="dropdown">
                <div class="chat-action-btn" onclick="toggleSidebarThreeDotMenu()">⋮</div>
                <div id="sidebarThreeDotMenu" class="dropdown-menu">
                    <div class="dropdown-item" onclick="toggleTheme()">
                        <span id="sidebarThemeIcon">🌙</span> <span id="sidebarThemeText">Dark Mode</span>
                    </div>
                    <div class="dropdown-item" onclick="openSettings()">
                        <span>⚙️</span> Settings
                    </div>
                    <div class="dropdown-separator"></div>
                    <div class="dropdown-item logout" onclick="logout()">
                        <span>🚪</span> Logout
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="user-list">
        @foreach($users as $user)
            <div class="user" onclick="openChat({{ $user->id }}, '{{ $user->name }}')" id="user-{{ $user->id }}">
                <div class="user-avatar" style="{{ $user->avatar ? 'background-image: url(' . asset('storage/' . $user->avatar) . '); background-size: cover; background-position: center;' : '' }}">{{ $user->avatar ? '' : '<i class="fas fa-user"></i>' }}</div>
                <div class="user-info">
                    <div class="user-name">{{ $user->name }}</div>
                    <div class="user-status">
                        {{ $user->last_seen ? 'Last seen '.$user->last_seen->diffForHumans() : 'Offline' }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- CHAT -->
<div class="chat" id="chat">
    <div class="chat-header">
        <div class="chat-header-left">
            <div class="back-btn" onclick="goBack()">←</div>
            <div class="chat-header-avatar" id="chatAvatar">U</div>
            <div class="chat-header-info">
                <div class="chat-header-name" id="chatName">Select a chat</div>
                <div class="chat-header-status">Online</div>
            </div>
        </div>
        <div class="chat-header-right">
            <!-- Call Icon with Dropdown -->
            <div class="dropdown">
                <div class="chat-action-btn" onclick="toggleCallDropdown()">
                    📞
                </div>
                <div id="callDropdown" class="dropdown-menu">
                    <div class="dropdown-item" onclick="makeCall('voice')">
                        <span>📞</span> Voice Call
                    </div>
                    <div class="dropdown-item" onclick="makeCall('video')">
                        <span>📹</span> Video Call
                    </div>
                </div>
            </div>
            
            <!-- 3-dot Menu -->
            <div class="dropdown">
                <div class="chat-action-btn" onclick="toggleChatMenuDropdown()">
                    ⋮
                </div>
                <div id="chatMenuDropdown" class="dropdown-menu">
                    <div class="dropdown-item" onclick="clearChat()">
                        <span>🗑️</span> Clear Chat
                    </div>
                    <div class="dropdown-item" onclick="openSettings()">
                        <span>⚙️</span> Settings
                    </div>
                    <div class="dropdown-item" onclick="toggleTheme()">
                        <span>🌙</span> <span id="themeText">Dark Mode</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="messages" id="messages"></div>
    
    <div id="typing" class="typing">
        <span>Typing</span>
        <div class="typing-dots">
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
        </div>
    </div>

    <div class="input-container">
        <div class="input-box">
            <div class="input-left-actions">
                <button class="input-btn emoji-btn" onclick="toggleEmojiPicker()"><i class="fas fa-smile"></i></button>
            </div>
            <input type="text" id="msg" placeholder="Type a message" onkeypress="handleKeyPress(event)" oninput="toggleActionButton(this.value)">
            <div class="input-actions">
                <button type="button" class="input-btn" onclick="showAttachmentPopup()">
                    <i class="fas fa-paperclip"></i>
                </button>
                <input type="file" id="img" accept="image/*" style="display:none;" onchange="handleImageUpload(event)">
                <button id="micButton" class="input-btn" onclick="handleActionButton()"><i class="fas fa-microphone"></i></button>
            </div>
        </div>
    </div>

    <!-- ATTACHMENT POPUP -->
    <div id="attachmentPopup" class="attachment-popup" style="display: none;">
        <div class="attachment-popup-overlay" onclick="hideAttachmentPopup()"></div>
        <div class="attachment-popup-content">
            <div class="attachment-popup-header">
                <h3>Attach File</h3>
                <button class="attachment-popup-close" onclick="hideAttachmentPopup()">×</button>
            </div>
            <div class="attachment-popup-options">
                <div class="attachment-option" onclick="selectAttachmentOption('camera')">
                    <div class="attachment-option-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="attachment-option-text">
                        <div class="attachment-option-title">Camera</div>
                        <div class="attachment-option-desc">Take a photo</div>
                    </div>
                </div>
                <div class="attachment-option" onclick="selectAttachmentOption('gallery')">
                    <div class="attachment-option-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="attachment-option-text">
                        <div class="attachment-option-title">Gallery</div>
                        <div class="attachment-option-desc">Choose from photos</div>
                    </div>
                </div>
                <div class="attachment-option" onclick="selectAttachmentOption('location')">
                    <div class="attachment-option-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="attachment-option-text">
                        <div class="attachment-option-title">Location</div>
                        <div class="attachment-option-desc">Share your location</div>
                    </div>
                </div>
                <div class="attachment-option" onclick="selectAttachmentOption('document')">
                    <div class="attachment-option-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="attachment-option-text">
                        <div class="attachment-option-title">Document</div>
                        <div class="attachment-option-desc">Choose a file</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EMOJI PICKER -->
    <div id="emojiPicker" class="emoji-picker">
        <div class="emoji-picker-header">
            <div class="emoji-picker-tabs">
                <button class="emoji-tab active" onclick="switchEmojiTab('emoji')" data-tab="emoji">
                    <span class="emoji-tab-icon">😊</span>
                    <span class="emoji-tab-label">Emoji</span>
                </button>
                <button class="emoji-tab" onclick="switchEmojiTab('gif')" data-tab="gif">
                    <span class="emoji-tab-icon">🎬</span>
                    <span class="emoji-tab-label">GIF</span>
                </button>
                <button class="emoji-tab" onclick="switchEmojiTab('sticker')" data-tab="sticker">
                    <span class="emoji-tab-icon">🎨</span>
                    <span class="emoji-tab-label">Sticker</span>
                </button>
            </div>
            <button class="emoji-picker-close" onclick="closeEmojiPicker()">×</button>
        </div>
        <div class="emoji-picker-content">
            <!-- EMOJI TAB -->
            <div id="emojiTab" class="emoji-tab-content active">
                <div class="emoji-category">
                    <div class="emoji-category-title">Smileys & People</div>
                    <div class="emoji-grid">
                        <span class="emoji-item" onclick="insertEmoji('😀')">😀</span>
                        <span class="emoji-item" onclick="insertEmoji('😃')">😃</span>
                        <span class="emoji-item" onclick="insertEmoji('😄')">😄</span>
                        <span class="emoji-item" onclick="insertEmoji('😁')">😁</span>
                        <span class="emoji-item" onclick="insertEmoji('😆')">😆</span>
                        <span class="emoji-item" onclick="insertEmoji('😅')">😅</span>
                        <span class="emoji-item" onclick="insertEmoji('🤣')">🤣</span>
                        <span class="emoji-item" onclick="insertEmoji('😂')">😂</span>
                        <span class="emoji-item" onclick="insertEmoji('🙂')">🙂</span>
                        <span class="emoji-item" onclick="insertEmoji('🙃')">🙃</span>
                        <span class="emoji-item" onclick="insertEmoji('😉')">😉</span>
                        <span class="emoji-item" onclick="insertEmoji('😊')">😊</span>
                        <span class="emoji-item" onclick="insertEmoji('😇')">😇</span>
                        <span class="emoji-item" onclick="insertEmoji('🥰')">🥰</span>
                        <span class="emoji-item" onclick="insertEmoji('😍')">😍</span>
                        <span class="emoji-item" onclick="insertEmoji('🤩')">🤩</span>
                        <span class="emoji-item" onclick="insertEmoji('😘')">😘</span>
                        <span class="emoji-item" onclick="insertEmoji('😗')">😗</span>
                        <span class="emoji-item" onclick="insertEmoji('😚')">😚</span>
                        <span class="emoji-item" onclick="insertEmoji('😙')">😙</span>
                        <span class="emoji-item" onclick="insertEmoji('😋')">😋</span>
                    </div>
                </div>
                <div class="emoji-category">
                    <div class="emoji-category-title">Gestures</div>
                    <div class="emoji-grid">
                        <span class="emoji-item" onclick="insertEmoji('👍')">👍</span>
                        <span class="emoji-item" onclick="insertEmoji('👎')">👎</span>
                        <span class="emoji-item" onclick="insertEmoji('👌')">👌</span>
                        <span class="emoji-item" onclick="insertEmoji('✌️')">✌️</span>
                        <span class="emoji-item" onclick="insertEmoji('🤞')">🤞</span>
                        <span class="emoji-item" onclick="insertEmoji('🤟')">🤟</span>
                        <span class="emoji-item" onclick="insertEmoji('🤘')">🤘</span>
                        <span class="emoji-item" onclick="insertEmoji('🤙')">🤙</span>
                        <span class="emoji-item" onclick="insertEmoji('👈')">👈</span>
                        <span class="emoji-item" onclick="insertEmoji('👉')">👉</span>
                        <span class="emoji-item" onclick="insertEmoji('👆')">👆</span>
                        <span class="emoji-item" onclick="insertEmoji('👇')">👇</span>
                        <span class="emoji-item" onclick="insertEmoji('☝️')">☝️</span>
                        <span class="emoji-item" onclick="insertEmoji('✋')">✋</span>
                        <span class="emoji-item" onclick="insertEmoji('🤚')">🤚</span>
                        <span class="emoji-item" onclick="insertEmoji('🖐️')">🖐️</span>
                        <span class="emoji-item" onclick="insertEmoji('🖖')">🖖</span>
                        <span class="emoji-item" onclick="insertEmoji('👋')">👋</span>
                        <span class="emoji-item" onclick="insertEmoji('🤝')">🤝</span>
                        <span class="emoji-item" onclick="insertEmoji('🙏')">🙏</span>
                    </div>
                </div>
                <div class="emoji-category">
                    <div class="emoji-category-title">Objects</div>
                    <div class="emoji-grid">
                        <span class="emoji-item" onclick="insertEmoji('❤️')">❤️</span>
                        <span class="emoji-item" onclick="insertEmoji('🧡')">🧡</span>
                        <span class="emoji-item" onclick="insertEmoji('💛')">💛</span>
                        <span class="emoji-item" onclick="insertEmoji('💚')">💚</span>
                        <span class="emoji-item" onclick="insertEmoji('💙')">💙</span>
                        <span class="emoji-item" onclick="insertEmoji('💜')">💜</span>
                        <span class="emoji-item" onclick="insertEmoji('🖤')">🖤</span>
                        <span class="emoji-item" onclick="insertEmoji('🤍')">🤍</span>
                        <span class="emoji-item" onclick="insertEmoji('🤎')">🤎</span>
                        <span class="emoji-item" onclick="insertEmoji('💔')">💔</span>
                        <span class="emoji-item" onclick="insertEmoji('❣️')">❣️</span>
                        <span class="emoji-item" onclick="insertEmoji('💕')">💕</span>
                        <span class="emoji-item" onclick="insertEmoji('💞')">💞</span>
                        <span class="emoji-item" onclick="insertEmoji('💓')">💓</span>
                        <span class="emoji-item" onclick="insertEmoji('💗')">💗</span>
                        <span class="emoji-item" onclick="insertEmoji('💖')">💖</span>
                        <span class="emoji-item" onclick="insertEmoji('💘')">💘</span>
                        <span class="emoji-item" onclick="insertEmoji('💝')">💝</span>
                        <span class="emoji-item" onclick="insertEmoji('🔥')">🔥</span>
                        <span class="emoji-item" onclick="insertEmoji('⭐')">⭐</span>
                    </div>
                </div>
            </div>

            <!-- GIF TAB -->
            <div id="gifTab" class="emoji-tab-content">
                <div class="gif-search-container">
                    <input type="text" class="gif-search-input" placeholder="Search GIFs..." onkeyup="searchGifs(this.value)">
                    <button class="gif-search-btn" onclick="searchGifs()">🔍</button>
                </div>
                <div class="gif-grid" id="gifGrid">
                    <!-- Popular GIFs -->
                    <div class="gif-item" onclick="sendGif('https://media.giphy.com/media/3o7TKUM1IgqFOpVWfo/giphy.gif')">
                        <img src="https://media.giphy.com/media/3o7TKUM1IgqFOpVWfo/giphy.gif" alt="GIF" loading="lazy">
                    </div>
                    <div class="gif-item" onclick="sendGif('https://media.giphy.com/media/l0ExayQDz5Ia0a8TS/giphy.gif')">
                        <img src="https://media.giphy.com/media/l0ExayQDz5Ia0a8TS/giphy.gif" alt="GIF" loading="lazy">
                    </div>
                    <div class="gif-item" onclick="sendGif('https://media.giphy.com/media/3o7aD2saalBwwftBIY/giphy.gif')">
                        <img src="https://media.giphy.com/media/3o7aD2saalBwwftBIY/giphy.gif" alt="GIF" loading="lazy">
                    </div>
                    <div class="gif-item" onclick="sendGif('https://media.giphy.com/media/3o6Zt6Y0YfVh6lX8E/giphy.gif')">
                        <img src="https://media.giphy.com/media/3o6Zt6Y0YfVh6lX8E/giphy.gif" alt="GIF" loading="lazy">
                    </div>
                    <div class="gif-item" onclick="sendGif('https://media.giphy.com/media/3o7aD4Zw9YbVjI4eM/giphy.gif')">
                        <img src="https://media.giphy.com/media/3o7aD4Zw9YbVjI4eM/giphy.gif" alt="GIF" loading="lazy">
                    </div>
                    <div class="gif-item" onclick="sendGif('https://media.giphy.com/media/3o6ZsYqL2QxXn6qJ6/giphy.gif')">
                        <img src="https://media.giphy.com/media/3o6ZsYqL2QxXn6qJ6/giphy.gif" alt="GIF" loading="lazy">
                    </div>
                    <div class="gif-item" onclick="sendGif('https://media.giphy.com/media/3o7aD3Xy4y4y4y4y4/giphy.gif')">
                        <img src="https://media.giphy.com/media/3o7aD3Xy4y4y4y4y4/giphy.gif" alt="GIF" loading="lazy">
                    </div>
                    <div class="gif-item" onclick="sendGif('https://media.giphy.com/media/3o7aD2ZJ9l5y4y4y4/giphy.gif')">
                        <img src="https://media.giphy.com/media/3o7aD2ZJ9l5y4y4y4/giphy.gif" alt="GIF" loading="lazy">
                    </div>
                </div>
                <div class="gif-loading" id="gifLoading" style="display: none;">
                    <div class="loading-spinner"></div>
                    <span>Loading GIFs...</span>
                </div>
            </div>

            <!-- STICKER TAB -->
            <div id="stickerTab" class="emoji-tab-content">
                <div class="sticker-categories">
                    <div class="sticker-category">
                        <div class="sticker-category-title">Popular</div>
                        <div class="sticker-grid">
                            <div class="sticker-item" onclick="sendSticker('😀')">
                                <div class="sticker-emoji">😀</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('😂')">
                                <div class="sticker-emoji">😂</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('❤️')">
                                <div class="sticker-emoji">❤️</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('👍')">
                                <div class="sticker-emoji">👍</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🔥')">
                                <div class="sticker-emoji">🔥</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🎉')">
                                <div class="sticker-emoji">🎉</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🤔')">
                                <div class="sticker-emoji">🤔</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('😎')">
                                <div class="sticker-emoji">😎</div>
                            </div>
                        </div>
                    </div>
                    <div class="sticker-category">
                        <div class="sticker-category-title">Animals</div>
                        <div class="sticker-grid">
                            <div class="sticker-item" onclick="sendSticker('🐶')">
                                <div class="sticker-emoji">🐶</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🐱')">
                                <div class="sticker-emoji">🐱</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🐭')">
                                <div class="sticker-emoji">🐭</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🐹')">
                                <div class="sticker-emoji">🐹</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🦊')">
                                <div class="sticker-emoji">🦊</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🐻')">
                                <div class="sticker-emoji">🐻</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🐼')">
                                <div class="sticker-emoji">🐼</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🐨')">
                                <div class="sticker-emoji">🐨</div>
                            </div>
                        </div>
                    </div>
                    <div class="sticker-category">
                        <div class="sticker-category-title">Food & Drink</div>
                        <div class="sticker-grid">
                            <div class="sticker-item" onclick="sendSticker('🍕')">
                                <div class="sticker-emoji">🍕</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍔')">
                                <div class="sticker-emoji">🍔</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍟')">
                                <div class="sticker-emoji">🍟</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍿')">
                                <div class="sticker-emoji">🍿</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍩')">
                                <div class="sticker-emoji">🍩</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍪')">
                                <div class="sticker-emoji">🍪</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍫')">
                                <div class="sticker-emoji">🍫</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍰')">
                                <div class="sticker-emoji">🍰</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍎')">
                                <div class="sticker-emoji">🍎</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍊')">
                                <div class="sticker-emoji">🍊</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍇')">
                                <div class="sticker-emoji">🍇</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍓')">
                                <div class="sticker-emoji">🍓</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🥤')">
                                <div class="sticker-emoji">🥤</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍺')">
                                <div class="sticker-emoji">🍺</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('☕')">
                                <div class="sticker-emoji">☕</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🍷')">
                                <div class="sticker-emoji">🍷</div>
                            </div>
                        </div>
                    </div>
                    <div class="sticker-category">
                        <div class="sticker-category-title">Trivial & Places</div>
                        <div class="sticker-grid">
                            <div class="sticker-item" onclick="sendSticker('🏠')">
                                <div class="sticker-emoji">🏠</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🏢')">
                                <div class="sticker-emoji">🏢</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🏰')">
                                <div class="sticker-emoji">🏰</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🗽')">
                                <div class="sticker-emoji">🗽</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🌉')">
                                <div class="sticker-emoji">🌉</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('⛰️')">
                                <div class="sticker-emoji">⛰️</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🏖️')">
                                <div class="sticker-emoji">🏖️</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🌴')">
                                <div class="sticker-emoji">🌴</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🚗')">
                                <div class="sticker-emoji">🚗</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('✈️')">
                                <div class="sticker-emoji">✈️</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🚀')">
                                <div class="sticker-emoji">🚀</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('⚽')">
                                <div class="sticker-emoji">⚽</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🎮')">
                                <div class="sticker-emoji">🎮</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🎯')">
                                <div class="sticker-emoji">🎯</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🎲')">
                                <div class="sticker-emoji">🎲</div>
                            </div>
                            <div class="sticker-item" onclick="sendSticker('🏆')">
                                <div class="sticker-emoji">🏆</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- FULLSCREEN IMAGE VIEWER -->
<div id="imageViewer" class="image-viewer">
    <button class="image-viewer-close" onclick="closeImageViewer()">×</button>
    <div class="image-viewer-loading" id="imageViewerLoading" style="display: none;"></div>
    <img id="imageViewerContent" class="image-viewer-content" src="" alt="Full size image" style="display: none;">
</div>

<!-- MOBILE BOTTOM NAVIGATION -->
<div class="mobile-bottom-nav" id="mobileBottomNav">
    <a href="#" class="nav-item active" onclick="showChatScreen()">
        <div class="nav-icon"><i class="fas fa-comment"></i></div>
        <div class="nav-label">Chat</div>
        <div class="nav-badge" id="chatBadge" style="display:none;">0</div>
    </a>
    <a href="#" class="nav-item" onclick="showUpdatesScreen()">
        <div class="nav-icon"><i class="fas fa-sync-alt"></i></div>
        <div class="nav-label">Updates</div>
        <div class="nav-badge" id="updatesBadge" style="display:none;">0</div>
    </a>
    <a href="#" class="nav-item" onclick="showProfileScreen()">
        <div class="nav-icon"><i class="fas fa-user"></i></div>
        <div class="nav-label">Profile</div>
    </a>
</div>

<!-- PROFILE EDIT POPUP -->
<div class="profile-popup" id="profileEditPopup">
    <div class="profile-popup-content">
        <div class="profile-popup-header">
            <div class="profile-popup-title">Edit Profile</div>
            <button class="profile-popup-close" onclick="closeProfilePopup()">×</button>
        </div>
        
        <form id="profileEditForm">
            <div class="profile-form-group">
                <label class="profile-form-label">Name</label>
                <input type="text" class="profile-form-input" id="popupProfileName" value="{{ auth()->user()->name }}" placeholder="Enter your name">
            </div>
            
            <div class="profile-form-group">
                <label class="profile-form-label">About</label>
                <textarea class="profile-form-input profile-form-textarea" id="popupProfileAbout" placeholder="Tell us about yourself">Hey there! I am using Support Chat.</textarea>
            </div>
            
            <div class="profile-form-group">
                <label class="profile-form-label">Phone</label>
                <input type="tel" class="profile-form-input" id="popupProfilePhone" value="+91 98765 43210" placeholder="Enter your phone number">
            </div>
            
            <div class="profile-popup-buttons">
                <button type="button" class="profile-popup-btn profile-popup-btn-secondary" onclick="closeProfilePopup()">Cancel</button>
                <button type="submit" class="profile-popup-btn profile-popup-btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- ACCOUNT SETTINGS POPUP -->
<div class="profile-popup" id="accountSettingsPopup">
    <div class="profile-popup-content">
        <div class="profile-popup-header">
            <div class="profile-popup-title" id="settingsPopupTitle">Account Settings</div>
            <button class="profile-popup-close" onclick="closeSettingsPopup()">×</button>
        </div>
        
        <div id="settingsContent">
            <!-- Privacy Settings -->
            <div id="privacySettings" style="display:none;">
                <div class="profile-form-group">
                    <label class="profile-form-label">Last Seen</label>
                    <select class="profile-form-input">
                        <option>Everyone</option>
                        <option>My Contacts</option>
                        <option>Nobody</option>
                    </select>
                </div>
                
                <div class="profile-form-group">
                    <label class="profile-form-label">Profile Photo</label>
                    <select class="profile-form-input">
                        <option>Everyone</option>
                        <option>My Contacts</option>
                        <option>Nobody</option>
                    </select>
                </div>
                
                <div class="profile-form-group">
                    <label class="profile-form-label">About</label>
                    <select class="profile-form-input">
                        <option>Everyone</option>
                        <option>My Contacts</option>
                        <option>Nobody</option>
                    </select>
                </div>
                
                <div class="profile-form-group">
                    <label class="profile-form-label">Status</label>
                    <select class="profile-form-input">
                        <option>Everyone</option>
                        <option>My Contacts</option>
                        <option>Nobody</option>
                    </select>
                </div>
            </div>
            
            <!-- Security Settings -->
            <div id="securitySettings" style="display:none;">
                <div class="profile-form-group">
                    <label class="profile-form-label">Two-Step Verification</label>
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="color:#8696a0;font-size:12px;">Add an extra layer of security</span>
                        <button type="button" class="profile-popup-btn profile-popup-btn-primary" style="width:auto;padding:8px 16px;">Enable</button>
                    </div>
                </div>
                
                <div class="profile-form-group">
                    <label class="profile-form-label">Security Notifications</label>
                    <select class="profile-form-input">
                        <option>Enabled</option>
                        <option>Disabled</option>
                    </select>
                </div>
                
                <div class="profile-form-group">
                    <label class="profile-form-label">Blocked Contacts</label>
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="color:#8696a0;font-size:12px;">0 blocked contacts</span>
                        <button type="button" class="profile-popup-btn profile-popup-btn-secondary" style="width:auto;padding:8px 16px;">View</button>
                    </div>
                </div>
            </div>
            
            <!-- Notifications Settings -->
            <div id="notificationsSettings" style="display:none;">
                <div class="profile-form-group">
                    <label class="profile-form-label">Message Notifications</label>
                    <select class="profile-form-input">
                        <option>On</option>
                        <option>Off</option>
                    </select>
                </div>
                
                <div class="profile-form-group">
                    <label class="profile-form-label">Group Notifications</label>
                    <select class="profile-form-input">
                        <option>On</option>
                        <option>Off</option>
                    </select>
                </div>
                
                <div class="profile-form-group">
                    <label class="profile-form-label">Notification Tone</label>
                    <select class="profile-form-input">
                        <option>Default</option>
                        <option>Bell</option>
                        <option>Chime</option>
                        <option>None</option>
                    </select>
                </div>
                
                <div class="profile-form-group">
                    <label class="profile-form-label">Vibration</label>
                    <select class="profile-form-input">
                        <option>On</option>
                        <option>Off</option>
                    </select>
                </div>
            </div>
            
            <!-- Storage Settings -->
            <div id="storageSettings" style="display:none;">
                <div class="profile-form-group">
                    <label class="profile-form-label">Network Usage</label>
                    <div style="background:#111b21;padding:15px;border-radius:8px;">
                        <div style="display:flex;justify-content:space-between;margin-bottom:10px;">
                            <span style="color:#8696a0;font-size:12px;">Messages Sent</span>
                            <span style="color:#f0f2f5;font-size:12px;">1,234</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:10px;">
                            <span style="color:#8696a0;font-size:12px;">Messages Received</span>
                            <span style="color:#f0f2f5;font-size:12px;">5,678</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;">
                            <span style="color:#8696a0;font-size:12px;">Media Shared</span>
                            <span style="color:#f0f2f5;font-size:12px;">890 MB</span>
                        </div>
                    </div>
                </div>
                
                <div class="profile-form-group">
                    <label class="profile-form-label">Storage Usage</label>
                    <div style="background:#111b21;padding:15px;border-radius:8px;">
                        <div style="display:flex;justify-content:space-between;margin-bottom:10px;">
                            <span style="color:#8696a0;font-size:12px;">Images</span>
                            <span style="color:#f0f2f5;font-size:12px;">450 MB</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:10px;">
                            <span style="color:#8696a0;font-size:12px;">Videos</span>
                            <span style="color:#f0f2f5;font-size:12px;">320 MB</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;">
                            <span style="color:#8696a0;font-size:12px;">Documents</span>
                            <span style="color:#f0f2f5;font-size:12px;">120 MB</span>
                        </div>
                    </div>
                </div>
                
                <div class="profile-form-group">
                    <button type="button" class="profile-popup-btn profile-popup-btn-secondary" style="width:100%;">Clear Storage</button>
                </div>
            </div>
            
            <div class="profile-popup-buttons">
                <button type="button" class="profile-popup-btn profile-popup-btn-secondary" onclick="closeSettingsPopup()">Close</button>
                <button type="button" class="profile-popup-btn profile-popup-btn-primary" onclick="saveSettings()">Save Settings</button>
            </div>
        </div>
    </div>
</div>

<!-- LOGOUT CONFIRMATION POPUP -->
<div class="profile-popup" id="logoutPopup">
    <div class="profile-popup-content" style="max-width:350px;">
        <div class="profile-popup-header">
            <div class="profile-popup-title">Logout</div>
            <button class="profile-popup-close" onclick="closeLogoutPopup()">×</button>
        </div>
        
        <div style="text-align:center;padding:20px 0;">
            <div style="width:60px;height:60px;border-radius:50%;background:#dc3545;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                <span style="color:white;font-size:24px;">🚪</span>
            </div>
            
            <h3 style="color:#f0f2f5;margin-bottom:10px;">Are you sure?</h3>
            <p style="color:#8696a0;font-size:14px;margin-bottom:25px;">
                You will be logged out of your Support Chat account. You'll need to login again to access your chats.
            </p>
            
            <div class="profile-popup-buttons">
                <button type="button" class="profile-popup-btn profile-popup-btn-secondary" onclick="closeLogoutPopup()">Cancel</button>
                <button type="button" class="profile-popup-btn profile-popup-btn-primary" style="background:#dc3545;" onclick="confirmLogout()">Logout</button>
            </div>
        </div>
    </div>
</div>

<!-- STORY UPLOAD POPUP -->
<div class="profile-popup" id="storyPopup">
    <div class="profile-popup-content" style="max-width:400px;">
        <div class="profile-popup-header">
            <div class="profile-popup-title">Add to Your Story</div>
            <button class="profile-popup-close" onclick="closeStoryPopup()">×</button>
        </div>
        
        <div style="padding:20px 0;">
            <div style="text-align:center;margin-bottom:25px;">
                <div style="width:80px;height:80px;border-radius:50%;background:#25D366;display:flex;align-items:center;justify-content:center;margin:0 auto 15px;border:3px solid #111b21;">
                    <span style="color:#111b21;font-size:32px;">📸</span>
                </div>
                <h3 style="color:#f0f2f5;margin-bottom:5px;">Share Your Moment</h3>
                <p style="color:#8696a0;font-size:13px;">Add a photo or video to your status</p>
            </div>
            
            <div class="profile-form-group">
                <label class="profile-form-label">Story Type</label>
                <select class="profile-form-input" id="storyType" onchange="updateStoryOptions()">
                    <option value="photo">Photo</option>
                    <option value="video">Video</option>
                    <option value="text">Text Only</option>
                </select>
            </div>
            
            <div class="profile-form-group" id="photoUploadGroup">
                <label class="profile-form-label">Choose Photo</label>
                <div style="position:relative;">
                    <input type="file" id="storyPhotoInput" accept="image/*" style="display:none;" onchange="previewStoryPhoto(event)">
                    <div class="profile-form-input" style="cursor:pointer;padding:20px;text-align:center;background:#111b21;border:2px dashed #2a3942;" onclick="document.getElementById('storyPhotoInput').click()">
                        <div id="storyPhotoPreview" style="display:none;">
                            <img id="storyPreviewImg" style="max-width:100%;max-height:150px;border-radius:8px;" alt="Preview">
                        </div>
                        <div id="storyPhotoPlaceholder">
                            <span style="font-size:24px;">📷</span>
                            <div style="margin-top:5px;color:#8696a0;">Click to upload photo</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="profile-form-group" id="videoUploadGroup" style="display:none;">
                <label class="profile-form-label">Choose Video</label>
                <div style="position:relative;">
                    <input type="file" id="storyVideoInput" accept="video/*" style="display:none;" onchange="previewStoryVideo(event)">
                    <div class="profile-form-input" style="cursor:pointer;padding:20px;text-align:center;background:#111b21;border:2px dashed #2a3942;" onclick="document.getElementById('storyVideoInput').click()">
                        <div id="storyVideoPreview" style="display:none;">
                            <video id="storyPreviewVideo" style="max-width:100%;max-height:150px;border-radius:8px;" controls></video>
                        </div>
                        <div id="storyVideoPlaceholder">
                            <span style="font-size:24px;">🎥</span>
                            <div style="margin-top:5px;color:#8696a0;">Click to upload video</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="profile-form-group" id="textStoryGroup" style="display:none;">
                <label class="profile-form-label">Story Text</label>
                <textarea class="profile-form-input profile-form-textarea" id="storyText" placeholder="What's on your mind?" maxlength="200"></textarea>
                <div style="color:#8696a0;font-size:11px;text-align:right;margin-top:5px;">
                    <span id="textCount">0</span>/200 characters
                </div>
            </div>
            
            <div class="profile-form-group">
                <label class="profile-form-label">Story Duration</label>
                <select class="profile-form-input" id="storyDuration">
                    <option value="24">24 hours</option>
                    <option value="1">1 hour</option>
                    <option value="12">12 hours</option>
                </select>
            </div>
            
            <div class="profile-form-group">
                <label class="profile-form-label">
                    <input type="checkbox" id="storyPrivacy" style="margin-right:8px;">
                    Share with all contacts
                </label>
            </div>
            
            <div class="profile-popup-buttons">
                <button type="button" class="profile-popup-btn profile-popup-btn-secondary" onclick="closeStoryPopup()">Cancel</button>
                <button type="button" class="profile-popup-btn profile-popup-btn-primary" onclick="uploadStory()">Upload Story</button>
            </div>
        </div>
    </div>
</div>

<!-- STORY VIEWER POPUP -->
<div class="profile-popup" id="storyViewerPopup">
    <div class="profile-popup-content" style="max-width:90%;max-height:90vh;background:#000;border-radius:0;">
        <div style="position:relative;height:100vh;display:flex;flex-direction:column;">
            <!-- Story Header -->
            <div style="position:absolute;top:0;left:0;right:0;z-index:10;background:linear-gradient(to bottom, rgba(0,0,0,0.7), transparent);padding:20px;display:flex;align-items:center;justify-content:space-between;">
                <div style="display:flex;align-items:center;gap:15px;">
                    <div id="storyUserAvatar" style="width:40px;height:40px;border-radius:50%;background:#2a3942;display:flex;align-items:center;justify-content:center;border:2px solid #25D366;">
                        <span style="color:#f0f2f5;font-size:16px;">👤</span>
                    </div>
                    <div>
                        <div id="storyUserName" style="color:#f0f2f5;font-size:16px;font-weight:600;">User Name</div>
                        <div id="storyTime" style="color:#8696a0;font-size:12px;">2 hours ago</div>
                    </div>
                </div>
                <button class="profile-popup-close" onclick="closeStoryViewer()" style="background:rgba(0,0,0,0.5);color:white;">×</button>
            </div>
            
            <!-- Story Content -->
            <div style="flex:1;display:flex;align-items:center;justify-content:center;position:relative;">
                <div id="storyContent" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                    <!-- Photo Story -->
                    <div id="photoStoryContent" style="display:none;width:100%;height:100%;">
                        <img id="storyPhoto" style="width:100%;height:100%;object-fit:contain;" alt="Story">
                    </div>
                    
                    <!-- Video Story -->
                    <div id="videoStoryContent" style="display:none;width:100%;height:100%;">
                        <video id="storyVideo" style="width:100%;height:100%;object-fit:contain;" controls autoplay></video>
                    </div>
                    
                    <!-- Text Story -->
                    <div id="textStoryContent" style="display:none;width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                        <div style="text-align:center;padding:40px;">
                            <div id="storyTextContent" style="color:#f0f2f5;font-size:24px;line-height:1.5;max-width:80%;margin:0 auto;"></div>
                        </div>
                    </div>
                    
                    <!-- Default/Loading -->
                    <div id="defaultStoryContent" style="text-align:center;color:#8696a0;">
                        <div style="font-size:48px;margin-bottom:20px;">📸</div>
                        <div>Story loading...</div>
                    </div>
                </div>
                
                <!-- Story Progress Bar -->
                <div style="position:absolute;top:10px;left:20px;right:20px;height:2px;background:rgba(255,255,255,0.3);border-radius:1px;">
                    <div id="storyProgress" style="height:100%;background:#25D366;border-radius:1px;width:0%;transition:width 0.3s;"></div>
                </div>
            </div>
            
            <!-- Story Actions -->
            <div style="position:absolute;bottom:20px;left:20px;right:20px;z-index:10;">
                <!-- Reply Input -->
                <div id="storyReplySection" style="display:none;background:rgba(0,0,0,0.7);border-radius:20px;padding:15px;margin-bottom:15px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <input type="text" id="storyReplyInput" placeholder="Send a reply..." style="flex:1;background:transparent;border:none;color:white;padding:8px;font-size:14px;" onkeypress="handleStoryReplyKeypress(event)">
                        <button onclick="sendStoryReply()" style="background:#25D366;border:none;color:white;width:30px;height:30px;border-radius:50%;cursor:pointer;">➤</button>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div style="display:flex;justify-content:center;gap:15px;">
                    <button onclick="toggleStoryReply()" style="background:rgba(0,0,0,0.5);border:none;color:white;padding:10px 20px;border-radius:20px;cursor:pointer;">💬 Reply</button>
                    <button onclick="shareStory()" style="background:rgba(0,0,0,0.5);border:none;color:white;padding:10px 20px;border-radius:20px;cursor:pointer;">📤 Share</button>
                    <button onclick="deleteStory()" id="deleteStoryBtn" style="background:rgba(220,53,69,0.8);border:none;color:white;padding:10px 20px;border-radius:20px;cursor:pointer;display:none;">🗑️ Delete</button>
                </div>
                
                <!-- Story Reactions -->
                <div style="text-align:center;margin-top:15px;">
                    <div style="color:#8696a0;font-size:12px;margin-bottom:10px;">React to story</div>
                    <div style="display:flex;justify-content:center;gap:10px;">
                        <button onclick="reactToStory('❤️')" style="background:rgba(0,0,0,0.5);border:none;font-size:20px;padding:8px;border-radius:50%;cursor:pointer;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">❤️</button>
                        <button onclick="reactToStory('😂')" style="background:rgba(0,0,0,0.5);border:none;font-size:20px;padding:8px;border-radius:50%;cursor:pointer;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😂</button>
                        <button onclick="reactToStory('😮')" style="background:rgba(0,0,0,0.5);border:none;font-size:20px;padding:8px;border-radius:50%;cursor:pointer;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😮</button>
                        <button onclick="reactToStory('😢')" style="background:rgba(0,0,0,0.5);border:none;font-size:20px;padding:8px;border-radius:50%;cursor:pointer;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">😢</button>
                        <button onclick="reactToStory('🔥')" style="background:rgba(0,0,0,0.5);border:none;font-size:20px;padding:8px;border-radius:50%;cursor:pointer;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🔥</button>
                        <button onclick="reactToStory('👍')" style="background:rgba(0,0,0,0.5);border:none;font-size:20px;padding:8px;border-radius:50%;cursor:pointer;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">👍</button>
                    </div>
                </div>
                
                <!-- Story Stats -->
                <div style="text-align:center;margin-top:15px;">
                    <div id="storyStats" style="color:#8696a0;font-size:12px;">
                        <span id="storyViews">👁 23 views</span> • <span id="storyReactions">❤️ 5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Set CSRF token for all axios requests
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;

let receiver_id = null;

function openChat(id,name){
    receiver_id = id;
    
    // Update chat header with null checks
    const chatNameElement = document.getElementById('chatName');
    const chatAvatarElement = document.getElementById('chatAvatar');
    
    if (chatNameElement) {
        chatNameElement.innerText = name;
    }
    
    if (chatAvatarElement) {
        chatAvatarElement.innerText = name.charAt(0).toUpperCase();
    }
    
    // Update active user in sidebar with null checks
    const userElements = document.querySelectorAll('.user');
    userElements.forEach(user => {
        user.classList.remove('active');
    });
    
    const activeUserElement = document.getElementById('user-' + id);
    if (activeUserElement) {
        activeUserElement.classList.add('active');
    }

    // Load messages
    axios.get('/messages/'+id).then(res=>{
        let html='';
        if (res.data && res.data.length > 0) {
            res.data.forEach(m=>{
                html+=renderMsg(m);
            });
        } else {
            html = '<div style="text-align:center;color:#8696a0;padding:40px;">No messages yet. Start a conversation!</div>';
        }
        document.getElementById('messages').innerHTML = html;

        scrollBottom();
    });

    // MOBILE: open full screen chat
    const chatElement = document.getElementById('chat');
    chatElement.classList.add('active');
    chatElement.classList.remove('updates-screen', 'profile-screen');
    
    // Show input bar when opening chat
    const inputContainer = document.querySelector('.input-container');
    if (inputContainer) {
        inputContainer.style.display = 'block';
    }
    
    // Hide navigation menu when in chat
    const chatActions = document.querySelector('.chat-actions');
    if (chatActions) {
        chatActions.style.display = 'none';
    }
    
    // Start automatic message refresh
    startMessageRefresh();
}

function goBack(){
    document.getElementById('chat').classList.remove('active');
}

function renderMsg(m){
    // Handle null or undefined messages
    if (!m) return '';
    
    let me = m.sender_id == {{ auth()->id() }};
    let seenStatus = me ? (m.seen ? '✔✔' : '✔') : '';
    
    // Generate reply preview HTML
    let replyPreview = '';
    if (m.reply_to_id && m.reply_to_content) {
        replyPreview = `
            <div class="msg-reply" onclick="scrollToMessage(${m.reply_to_id})">
                <div class="reply-line"></div>
                <div class="reply-content">
                    <div class="reply-text">${m.reply_to_content.length > 50 ? m.reply_to_content.substring(0, 50) + '...' : m.reply_to_content}</div>
                </div>
            </div>
        `;
    }
    
    // Handle different message types
    let content = '';
    if (m.image_path) {
        content = `<div class="msg-image-container">
            <img src="/storage/${m.image_path}" class="msg-image" alt="${m.image_name || 'Image'}" onclick="openImageViewer('/storage/${m.image_path}')">
        </div>`;
    } else if (m.file_path) {
        content = `<img src="/storage/${m.file_path}" style="border-radius:12px;max-width:200px;height:auto;">`;
    } else if (m.audio_path) {
        const audioName = m.audio_name || 'Audio';
        const audioSize = m.audio_size ? (m.audio_size / 1024 / 1024).toFixed(1) + ' MB' : '';
        content = `<div class="msg-audio-container">
            <div class="msg-audio-player" onclick="toggleAudioPlayback('${m.audio_path}', this)">
                <div class="audio-icon">🎙️</div>
                <div class="audio-info">
                    <div class="audio-name">${audioName}</div>
                    <div class="audio-size">${audioSize}</div>
                    <div class="audio-duration">0:00</div>
                </div>
                <div class="audio-play-btn">▶️</div>
            </div>
        </div>`;
    } else if (m.content) {
        content = `<div class="msg-content">${m.content}</div>`;
    } else if (m.message) {
        content = `<div class="msg-content">${m.message}</div>`; // Fallback for different format
    } else {
        content = `<div class="msg-content">[Empty message]</div>`;
    }
    
    // Format time
    let time = '';
    if (m.created_at) {
        let date = new Date(m.created_at);
        time = date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
    }
    
    return `<div class="msg ${me?'me':'other'}" data-message-id="${m.id}" data-sender-id="${m.sender_id}" data-content="${(m.content || m.message || '').replace(/'/g, "\\'")}" oncontextmenu="showContextMenu(event, ${m.id}, '${(m.content || m.message || '').replace(/'/g, "\\'")}', ${m.sender_id})" ontouchstart="handleTouchStart(event, ${m.id}, '${(m.content || m.message || '').replace(/'/g, "\\'")}', ${m.sender_id})" ontouchmove="handleTouchMove(event)" ontouchend="handleTouchEnd(event, ${m.id}, '${(m.content || m.message || '').replace(/'/g, "\\'")}', ${m.sender_id})" onclick="handleMessageClick(event, ${m.id}, '${(m.content || m.message || '').replace(/'/g, "\\'")}', ${m.sender_id})">
        <div class="message-checkbox">
            <input type="checkbox" id="check-${m.id}" onchange="toggleMessageSelection(${m.id})">
            <span class="checkmark"></span>
        </div>
        ${replyPreview}
        <div class="msg-bubble">
            ${content}
            <div class="msg-time">
                ${time} ${seenStatus}
            </div>
        </div>
    </div>`;
}

// Reply functionality
let replyingToMessageId = null;
let replyingToContent = '';

function replyToMessage(messageId, content, senderId) {
    // Don't reply to own messages
    if (senderId == {{ auth()->id() }}) return;
    
    // Set reply context
    replyingToMessageId = messageId;
    replyingToContent = content;
    
    // Mobile detection
    const isMobile = window.innerWidth <= 768;
    
    // Show reply input with mobile enhancements
    const replyContainer = document.getElementById('replyInputContainer');
    if (!replyContainer) {
        // Create reply input container if it doesn't exist
        const inputContainer = document.querySelector('.input-container');
        if (!inputContainer) return; // Safety check
        
        const mobileClass = isMobile ? 'mobile-reply' : '';
        const replyHtml = `
            <div id="replyInputContainer" class="reply-input-container ${mobileClass}">
                <div class="reply-content">
                    <div style="color:#8696a0;font-size:12px;margin-bottom:4px;">Replying to:</div>
                    <div style="color:#f0f2f5;font-size:13px;">${content.length > 30 ? content.substring(0, 30) + '...' : content}</div>
                </div>
                <button class="reply-cancel" onclick="cancelReply()">×</button>
            </div>
        `;
        inputContainer.insertAdjacentHTML('beforebegin', replyHtml);
        
        // Add mobile-specific CSS if needed
        if (isMobile && !document.querySelector('#mobileReplyCSS')) {
            const style = document.createElement('style');
            style.id = 'mobileReplyCSS';
            style.textContent = `
                .mobile-reply {
                    background: rgba(37, 211, 102, 0.15);
                    border: 1px solid rgba(37, 211, 102, 0.3);
                    animation: slideUp 0.3s ease-out;
                }
                
                @keyframes slideUp {
                    from { 
                        opacity: 0; 
                        transform: translateY(20px); 
                    }
                    to { 
                        opacity: 1; 
                        transform: translateY(0); 
                    }
                }
                
                .mobile-reply .reply-content {
                    flex: 1;
                    margin-right: 10px;
                }
                
                .mobile-reply .reply-cancel {
                    flex-shrink: 0;
                }
            `;
            document.head.appendChild(style);
        }
    } else {
        // Update existing reply container
        const replyContentElement = replyContainer.querySelector('.reply-content div:last-child');
        if (replyContentElement) {
            replyContentElement.textContent = content.length > 30 ? content.substring(0, 30) + '...' : content;
        }
        replyContainer.classList.add('active');
        
        // Add mobile class if needed
        if (isMobile) {
            replyContainer.classList.add('mobile-reply');
        }
    }
    
    // Focus on message input with mobile optimization
    const messageInput = document.getElementById('msg');
    if (messageInput) {
        messageInput.focus();
    }
    
    // Mobile-specific enhancements
    if (isMobile) {
        // Add haptic feedback
        if (navigator.vibrate) {
            navigator.vibrate(30);
        }
        
        // Ensure virtual keyboard doesn't hide the reply input
        setTimeout(() => {
            const currentReplyContainer = document.getElementById('replyInputContainer');
            if (currentReplyContainer && currentReplyContainer.scrollIntoView) {
                currentReplyContainer.scrollIntoView({ behavior: 'smooth', block: 'end' });
            }
        }, 300);
        
        // Add visual feedback
        const currentReplyContainer = document.getElementById('replyInputContainer');
        if (currentReplyContainer && currentReplyContainer.style) {
            currentReplyContainer.style.animation = 'none';
            setTimeout(() => {
                if (currentReplyContainer.style) {
                    currentReplyContainer.style.animation = '';
                }
            }, 10);
        }
    }
}

function cancelReply() {
    const replyContainer = document.getElementById('replyInputContainer');
    if (replyContainer) {
        replyContainer.classList.remove('active');
    }
    replyingToMessageId = null;
    replyingToContent = '';
    
    // Clear focus from input
    const messageInput = document.getElementById('msg');
    if (messageInput) {
        messageInput.blur();
    }
}

function scrollToMessage(messageId) {
    const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
    if (messageElement) {
        // Remove existing highlights
        document.querySelectorAll('.msg.highlight').forEach(msg => {
            msg.classList.remove('highlight');
        });
        
        // Add highlight to target message
        messageElement.classList.add('highlight');
        
        // Enhanced mobile scroll behavior
        const isMobile = window.innerWidth <= 768;
        
        if (isMobile) {
            // Mobile-specific scroll with better positioning
            const messagesContainer = document.getElementById('messages');
            if (messagesContainer) {
                const containerRect = messagesContainer.getBoundingClientRect();
                const messageRect = messageElement.getBoundingClientRect();
                
                // Calculate optimal scroll position
                const targetScrollTop = messagesContainer.scrollTop + 
                    (messageRect.top - containerRect.top) - 
                    (containerRect.height * 0.3); // Position at 30% from top
                
                // Smooth scroll with mobile optimization
                messagesContainer.scrollTo({
                    top: targetScrollTop,
                    behavior: 'smooth'
                });
            } else {
                // Fallback to basic scrollIntoView
                messageElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            
            // Add haptic feedback if supported
            if (navigator.vibrate) {
                navigator.vibrate(50); // Light vibration for feedback
            }
            
            // Remove highlight after mobile animation (longer duration)
            setTimeout(() => {
                messageElement.classList.remove('highlight');
            }, 2500);
        } else {
            // Desktop scroll behavior
            messageElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // Remove highlight after desktop animation
            setTimeout(() => {
                messageElement.classList.remove('highlight');
            }, 2000);
        }
        
        // Show scroll indicator for mobile
        if (isMobile) {
            showScrollIndicator(messageElement);
        }
    }
}

function showScrollIndicator(messageElement) {
    // Create temporary scroll indicator
    const indicator = document.createElement('div');
    indicator.style.cssText = `
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(37, 211, 102, 0.9);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        z-index: 1000;
        pointer-events: none;
        animation: fadeInOut 1.5s ease-in-out;
    `;
    indicator.textContent = 'Jumped to reply';
    
    // Add animation CSS if not exists
    if (!document.querySelector('#scrollIndicatorCSS')) {
        const style = document.createElement('style');
        style.id = 'scrollIndicatorCSS';
        style.textContent = `
            @keyframes fadeInOut {
                0% { opacity: 0; transform: translate(-50%, -50%) scale(0.8); }
                50% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
                100% { opacity: 0; transform: translate(-50%, -50%) scale(0.9); }
            }
        `;
        document.head.appendChild(style);
    }
    
    // Position indicator relative to message
    const messageRect = messageElement.getBoundingClientRect();
    const containerRect = document.getElementById('messages').getBoundingClientRect();
    indicator.style.top = (messageRect.top - containerRect.top + messageRect.height / 2) + 'px';
    
    document.getElementById('messages').appendChild(indicator);
    
    // Remove indicator after animation
    setTimeout(() => {
        indicator.remove();
    }, 1500);
}

// Desktop and Mobile Context Menu and Selection System
let contextMenuMessageId = null;
let contextMenuContent = '';
let contextMenuSenderId = null;
let selectedMessages = new Set();
let isSelectionMode = false;

// Mobile long-press detection
let longPressTimer;
let isLongPress = false;
let touchStartX = 0;
let touchStartY = 0;

function showContextMenu(event, messageId, content, senderId) {
    event.preventDefault();
    
    // Store context
    contextMenuMessageId = messageId;
    contextMenuContent = content;
    contextMenuSenderId = senderId;
    
    const isMobile = window.innerWidth <= 768;
    const menu = document.getElementById('contextMenu');
    menu.style.display = 'block';
    
    if (isMobile) {
        // Mobile positioning - bottom sheet
        menu.style.left = '0';
        menu.style.top = 'auto';
        menu.style.bottom = '0';
        menu.style.right = 'auto';
        
        // Add backdrop for mobile
        if (!document.getElementById('mobileBackdrop')) {
            const backdrop = document.createElement('div');
            backdrop.id = 'mobileBackdrop';
            backdrop.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 9999;
                animation: fadeIn 0.3s ease-out;
            `;
            backdrop.onclick = hideContextMenu;
            document.body.appendChild(backdrop);
        }
        
        // Prevent body scroll when menu is open
        document.body.style.overflow = 'hidden';
    } else {
        // Desktop positioning - at cursor
        menu.style.left = event.pageX + 'px';
        menu.style.top = event.pageY + 'px';
        
        // Adjust position if menu goes off screen
        const rect = menu.getBoundingClientRect();
        if (rect.right > window.innerWidth) {
            menu.style.left = (event.pageX - rect.width) + 'px';
        }
        if (rect.bottom > window.innerHeight) {
            menu.style.top = (event.pageY - rect.height) + 'px';
        }
    }
    
    // Hide menu when clicking elsewhere
    document.addEventListener('click', hideContextMenu);
    
    // Add haptic feedback for mobile
    if (isMobile && navigator.vibrate) {
        navigator.vibrate(50);
    }
}

// Mobile touch event handlers
function handleTouchStart(event, messageId, content, senderId) {
    const isMobile = window.innerWidth <= 768;
    if (!isMobile) return;
    
    const touch = event.touches[0];
    touchStartX = touch.clientX;
    touchStartY = touch.clientY;
    isLongPress = false;
    
    // Start long press timer
    longPressTimer = setTimeout(() => {
        isLongPress = true;
        showContextMenu(event, messageId, content, senderId);
    }, 500); // 500ms long press
}

function handleTouchMove(event) {
    const isMobile = window.innerWidth <= 768;
    if (!isMobile) return;
    
    const touch = event.touches[0];
    const moveX = Math.abs(touch.clientX - touchStartX);
    const moveY = Math.abs(touch.clientY - touchStartY);
    
    // Cancel long press if finger moved too much
    if (moveX > 10 || moveY > 10) {
        clearTimeout(longPressTimer);
    }
}

function handleTouchEnd(event, messageId, content, senderId) {
    const isMobile = window.innerWidth <= 768;
    if (!isMobile) return;
    
    clearTimeout(longPressTimer);
    
    // If not a long press, handle normal click
    if (!isLongPress && !isSelectionMode) {
        replyToMessage(messageId, content, senderId);
    }
}

function hideContextMenu() {
    const menu = document.getElementById('contextMenu');
    menu.style.display = 'none';
    document.removeEventListener('click', hideContextMenu);
    
    // Remove mobile backdrop if exists
    const backdrop = document.getElementById('mobileBackdrop');
    if (backdrop) {
        backdrop.remove();
    }
    
    // Restore body scroll for mobile
    document.body.style.overflow = '';
}

function handleMessageClick(event, messageId, content, senderId) {
    if (isSelectionMode) {
        // In selection mode, toggle checkbox
        event.stopPropagation();
        const checkbox = document.getElementById(`check-${messageId}`);
        checkbox.checked = !checkbox.checked;
        toggleMessageSelection(messageId);
    } else {
        // Normal click behavior - reply to message
        replyToMessage(messageId, content, senderId);
    }
}

// Context Menu Actions
function contextMenuReply() {
    hideContextMenu();
    replyToMessage(contextMenuMessageId, contextMenuContent, contextMenuSenderId);
}

function contextMenuForward() {
    hideContextMenu();
    enterSelectionMode();
    toggleMessageSelection(contextMenuMessageId);
    setTimeout(() => bulkForward(), 100);
}

function contextMenuCopy() {
    hideContextMenu();
    navigator.clipboard.writeText(contextMenuContent).then(() => {
        showNotification('Message copied to clipboard');
    });
}

function contextMenuEdit() {
    hideContextMenu();
    // Only allow editing own messages
    if (contextMenuSenderId == {{ auth()->id() }}) {
        const input = document.getElementById('msg');
        input.value = contextMenuContent;
        input.focus();
        input.select();
        showNotification('Edit your message and send again');
    } else {
        showNotification('You can only edit your own messages');
    }
}

function contextMenuSelect() {
    hideContextMenu();
    enterSelectionMode();
    toggleMessageSelection(contextMenuMessageId);
}

function contextMenuDelete() {
    hideContextMenu();
    if (contextMenuSenderId == {{ auth()->id() }}) {
        deleteMessage(contextMenuMessageId);
    } else {
        showNotification('You can only delete your own messages');
    }
}

function contextMenuClearChat() {
    hideContextMenu();
    clearChat(contextMenuSenderId);
}

// Selection Mode Functions
function enterSelectionMode() {
    isSelectionMode = true;
    selectedMessages.clear();
    
    // Show selection header
    document.getElementById('selectionHeader').classList.add('active');
    
    // Add selection mode to all messages
    document.querySelectorAll('.msg').forEach(msg => {
        msg.classList.add('selection-mode');
    });
    
    updateSelectionCount();
}

function exitSelectionMode() {
    isSelectionMode = false;
    selectedMessages.clear();
    
    // Hide selection header
    document.getElementById('selectionHeader').classList.remove('active');
    
    // Remove selection mode from all messages
    document.querySelectorAll('.msg').forEach(msg => {
        msg.classList.remove('selection-mode', 'selected');
        const checkbox = msg.querySelector('input[type="checkbox"]');
        if (checkbox) checkbox.checked = false;
    });
    
    updateSelectionCount();
}

function toggleMessageSelection(messageId) {
    const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
    const checkbox = document.getElementById(`check-${messageId}`);
    
    if (selectedMessages.has(messageId)) {
        selectedMessages.delete(messageId);
        messageElement.classList.remove('selected');
        checkbox.checked = false;
    } else {
        selectedMessages.add(messageId);
        messageElement.classList.add('selected');
        checkbox.checked = true;
    }
    
    updateSelectionCount();
}

function updateSelectionCount() {
    document.getElementById('selectedCount').textContent = selectedMessages.size;
}

// Bulk Actions
function bulkReply() {
    if (selectedMessages.size === 0) return;
    
    // Reply to the most recent selected message
    const messageIds = Array.from(selectedMessages);
    const lastMessageId = Math.max(...messageIds);
    const messageElement = document.querySelector(`[data-message-id="${lastMessageId}"]`);
    
    if (messageElement) {
        const content = messageElement.getAttribute('data-content') || 'Selected messages';
        const senderId = parseInt(messageElement.getAttribute('data-sender-id'));
        
        exitSelectionMode();
        replyToMessage(lastMessageId, content, senderId);
    }
}

function bulkForward() {
    if (selectedMessages.size === 0) return;
    
    showForwardDialog();
}

function bulkCopy() {
    if (selectedMessages.size === 0) return;
    
    const messages = [];
    selectedMessages.forEach(messageId => {
        const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
        const content = messageElement.querySelector('.msg-content')?.textContent || '';
        if (content) messages.push(content);
    });
    
    const textToCopy = messages.join('\n---\n');
    navigator.clipboard.writeText(textToCopy).then(() => {
        showNotification(`${messages.length} message(s) copied to clipboard`);
    });
}

function bulkDelete() {
    if (selectedMessages.size === 0) return;
    
    const count = selectedMessages.size;
    showDeletePopup('bulk', Array.from(selectedMessages));
}

// Forward Dialog Functions
function showForwardDialog() {
    const dialog = document.getElementById('forwardDialog');
    const userList = dialog.querySelector('.forward-user-list');
    
    // Populate user list (simplified - in real app, fetch from API)
    userList.innerHTML = `
        <div class="forward-user-item" onclick="selectForwardUser(1)">
            <div class="forward-user-avatar">U</div>
            <div class="forward-user-name">User 1</div>
        </div>
        <div class="forward-user-item" onclick="selectForwardUser(2)">
            <div class="forward-user-avatar">U</div>
            <div class="forward-user-name">User 2</div>
        </div>
        <div class="forward-user-item" onclick="selectForwardUser(3)">
            <div class="forward-user-avatar">U</div>
            <div class="forward-user-name">User 3</div>
        </div>
    `;
    
    dialog.style.display = 'block';
}

function closeForwardDialog() {
    document.getElementById('forwardDialog').style.display = 'none';
}

function selectForwardUser(userId) {
    // Store selected user for forwarding
    window.selectedForwardUserId = userId;
    
    // Highlight selected user
    document.querySelectorAll('.forward-user-item').forEach(item => {
        item.style.background = '';
    });
    event.target.closest('.forward-user-item').style.background = '#3b4a54';
}

function confirmForward() {
    if (!window.selectedForwardUserId) {
        showNotification('Please select a user to forward to');
        return;
    }
    
    // Forward messages (simplified - in real app, make API calls)
    const count = selectedMessages.size;
    showNotification(`Forwarded ${count} message(s) to user`);
    
    closeForwardDialog();
    exitSelectionMode();
}

// Utility Functions
function deleteMessage(messageId) {
    const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
    if (messageElement) {
        messageElement.style.animation = 'fadeOut 0.3s ease-out';
        setTimeout(() => {
            messageElement.remove();
        }, 300);
    }
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #25D366;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        z-index: 10000;
        animation: slideIn 0.3s ease-out;
    `;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'fadeOut 0.3s ease-out';
        setTimeout(() => notification.remove(), 300);
    }, 2000);
}

// Delete Popup Functions
let deleteType = '';
let deleteMessageIds = [];

function showDeletePopup(type, messageIds) {
    deleteType = type;
    deleteMessageIds = Array.isArray(messageIds) ? messageIds : [messageIds];
    
    const popup = document.getElementById('deletePopup');
    const messageText = document.getElementById('deleteMessageText');
    const warningText = document.getElementById('deleteWarningText');
    
    if (type === 'single') {
        messageText.textContent = 'This message will be permanently deleted.';
        warningText.textContent = 'Are you sure you want to delete this message? This action cannot be undone.';
    } else {
        const count = deleteMessageIds.length;
        messageText.textContent = `${count} messages will be permanently deleted.`;
        warningText.textContent = `Are you sure you want to delete ${count} message(s)? This action cannot be undone.`;
    }
    
    popup.style.display = 'block';
}

function closeDeletePopup() {
    document.getElementById('deletePopup').style.display = 'none';
    deleteType = '';
    deleteMessageIds = [];
}

function confirmDelete() {
    if (deleteType === 'single') {
        // Delete single message
        deleteMessage(deleteMessageIds[0]);
        showNotification('Message deleted');
    } else {
        // Delete multiple messages
        let deletedCount = 0;
        deleteMessageIds.forEach(messageId => {
            deleteMessage(messageId);
            deletedCount++;
        });
        
        exitSelectionMode();
        showNotification(`${deletedCount} message(s) deleted`);
    }
    
    closeDeletePopup();
}

// Chat Header Functions
function toggleCallDropdown() {
    const dropdown = document.getElementById('callDropdown');
    const threeDotMenu = document.getElementById('threeDotMenu');
    
    // Close other dropdowns
    if (threeDotMenu.classList.contains('show')) {
        threeDotMenu.classList.remove('show');
    }
    
    // Toggle current dropdown
    dropdown.classList.toggle('show');
    
    // Close dropdown when clicking outside
    if (dropdown.classList.contains('show')) {
        setTimeout(() => {
            document.addEventListener('click', closeDropdowns);
        }, 100);
    }
}

function toggleThreeDotMenu() {
    const dropdown = document.getElementById('threeDotMenu');
    const callDropdown = document.getElementById('callDropdown');
    
    // Close other dropdowns
    if (callDropdown.classList.contains('show')) {
        callDropdown.classList.remove('show');
    }
    
    // Toggle current dropdown
    dropdown.classList.toggle('show');
    
    // Close dropdown when clicking outside
    if (dropdown.classList.contains('show')) {
        setTimeout(() => {
            document.addEventListener('click', closeDropdowns);
        }, 100);
    }
}

function closeDropdowns() {
    const callDropdown = document.getElementById('callDropdown');
    const threeDotMenu = document.getElementById('threeDotMenu');
    const sidebarThreeDotMenu = document.getElementById('sidebarThreeDotMenu');
    
    if (callDropdown && callDropdown.classList) {
        callDropdown.classList.remove('show');
    }
    
    if (threeDotMenu && threeDotMenu.classList) {
        threeDotMenu.classList.remove('show');
    }
    
    if (sidebarThreeDotMenu && sidebarThreeDotMenu.classList) {
        sidebarThreeDotMenu.classList.remove('show');
    }
    
    document.removeEventListener('click', closeDropdowns);
}

function toggleSidebarThreeDotMenu() {
    const dropdown = document.getElementById('sidebarThreeDotMenu');
    const callDropdown = document.getElementById('callDropdown');
    const threeDotMenu = document.getElementById('threeDotMenu');
    
    // Close other dropdowns
    if (callDropdown && callDropdown.classList.contains('show')) {
        callDropdown.classList.remove('show');
    }
    
    if (threeDotMenu && threeDotMenu.classList.contains('show')) {
        threeDotMenu.classList.remove('show');
    }
    
    // Toggle current dropdown
    dropdown.classList.toggle('show');
    
    // Add event listener to close when clicking outside
    if (dropdown.classList.contains('show')) {
        setTimeout(() => {
            document.addEventListener('click', closeDropdowns);
        }, 100);
    }
}

function logout() {
    if (confirm('Are you sure you want to logout?')) {
        // Close dropdown
        closeDropdowns();
        
        // Show loading state
        showNotification('Logging out...');
        
        // Make logout request
        axios.post('/logout')
            .then(response => {
                if (response.data.redirect) {
                    window.location.href = response.data.redirect;
                } else {
                    // Fallback to login page
                    window.location.href = '/login';
                }
            })
            .catch(error => {
                console.error('Logout error:', error);
                showNotification('Logout failed. Please try again.');
                // Fallback: redirect to login page
                window.location.href = '/login';
            });
    }
}

function openSettings() {
    closeDropdowns();
    showNotification('Settings page coming soon!');
    // TODO: Implement settings page/modal
}

function makeCall(type) {
    closeDropdowns();
    
    if (!receiver_id) {
        showNotification('Please select a chat first');
        return;
    }
    
    const chatName = document.getElementById('chatName').textContent;
    
    if (type === 'voice') {
        showNotification(`Calling ${chatName}...`);
        // Simulate call functionality
        setTimeout(() => {
            showNotification('Voice call ended');
        }, 3000);
    } else if (type === 'video') {
        showNotification(`Video calling ${chatName}...`);
        // Simulate video call functionality
        setTimeout(() => {
            showNotification('Video call ended');
        }, 3000);
    }
}

function toggleSelectMode() {
    closeDropdowns();
    
    if (!receiver_id) {
        showNotification('Please select a chat first');
        return;
    }
    
    if (isSelectionMode) {
        exitSelectionMode();
    } else {
        enterSelectionMode();
    }
}

function clearChat() {
    closeDropdowns();
    
    if (!receiver_id) {
        showNotification('Please select a chat first');
        return;
    }
    
    if (confirm('Are you sure you want to clear all messages? This action cannot be undone.')) {
        // Clear messages from UI
        document.getElementById('messages').innerHTML = `
            <div style="text-align:center;color:#8696a0;padding:40px;">
                <div style="font-size:48px;margin-bottom:10px;">💬</div>
                <div>No messages yet. Start a conversation!</div>
            </div>
        `;
        
        showNotification('Chat cleared successfully');
        
        // In a real app, you would also clear messages from database
        // axios.delete(`/clear-chat/${receiver_id}`).then(...);
    }
}

function toggleTheme() {
    closeDropdowns();
    
    const body = document.body;
    const themeIcon = document.getElementById('themeIcon') || document.getElementById('sidebarThemeIcon');
    const themeText = document.getElementById('themeText') || document.getElementById('sidebarThemeText');
    
    if (body && body.classList) {
        if (body.classList.contains('light-mode')) {
            // Switch to dark mode
            body.classList.remove('light-mode');
            if (themeIcon) themeIcon.textContent = '🌙';
            if (themeText) themeText.textContent = 'Dark Mode';
            localStorage.setItem('theme', 'dark');
            showNotification('Switched to dark mode');
        } else {
            // Switch to light mode
            body.classList.add('light-mode');
            if (themeIcon) themeIcon.textContent = '☀️';
            if (themeText) themeText.textContent = 'Light Mode';
            localStorage.setItem('theme', 'light');
            showNotification('Switched to light mode');
        }
    }
}

// Initialize theme on page load
function initializeTheme() {
    const savedTheme = localStorage.getItem('theme');
    const themeIcon = document.getElementById('themeIcon') || document.getElementById('sidebarThemeIcon');
    const themeText = document.getElementById('themeText') || document.getElementById('sidebarThemeText');
    
    if (savedTheme === 'light' && document.body && document.body.classList) {
        document.body.classList.add('light-mode');
        if (themeIcon) themeIcon.textContent = '☀️';
        if (themeText) themeText.textContent = 'Light Mode';
    } else if (document.body && document.body.classList) {
        if (themeIcon) themeIcon.textContent = '🌙';
        if (themeText) themeText.textContent = 'Dark Mode';
    }
}

// Initialize theme when page loads
document.addEventListener('DOMContentLoaded', initializeTheme);

// Emoji Picker Functions
function toggleEmojiPicker() {
    const emojiPicker = document.getElementById('emojiPicker');
    const isMobile = window.innerWidth <= 768;
    
    if (emojiPicker.classList.contains('show')) {
        closeEmojiPicker();
    } else {
        emojiPicker.classList.add('show');
        
        // Position emoji picker for mobile vs desktop
        if (isMobile) {
            // Mobile: bottom sheet
            emojiPicker.style.position = 'fixed';
            emojiPicker.style.bottom = '0';
            emojiPicker.style.left = '0';
            emojiPicker.style.right = '0';
            emojiPicker.style.width = 'auto';
            emojiPicker.style.borderRadius = '20px 20px 0 0';
        } else {
            // Desktop: positioned near input
            const inputContainer = document.querySelector('.input-container');
            const inputRect = inputContainer.getBoundingClientRect();
            
            emojiPicker.style.position = 'absolute';
            emojiPicker.style.bottom = '80px';
            emojiPicker.style.left = '20px';
            emojiPicker.style.width = '320px';
            emojiPicker.style.borderRadius = '12px';
        }
        
        // Close when clicking outside
        setTimeout(() => {
            document.addEventListener('click', closeEmojiPickerOutside);
        }, 100);
        
        // Add haptic feedback on mobile
        if (isMobile && navigator.vibrate) {
            navigator.vibrate(50);
        }
    }
}

function closeEmojiPicker() {
    const emojiPicker = document.getElementById('emojiPicker');
    emojiPicker.classList.remove('show');
    document.removeEventListener('click', closeEmojiPickerOutside);
}

function closeEmojiPickerOutside(event) {
    const emojiPicker = document.getElementById('emojiPicker');
    const emojiBtn = document.querySelector('.emoji-btn');
    
    if (!emojiPicker.contains(event.target) && !emojiBtn.contains(event.target)) {
        closeEmojiPicker();
    }
}

function insertEmoji(emoji) {
    const inputField = document.getElementById('msg');
    const currentValue = inputField.value;
    const cursorPosition = inputField.selectionStart;
    
    // Insert emoji at cursor position
    const newValue = currentValue.slice(0, cursorPosition) + emoji + currentValue.slice(cursorPosition);
    inputField.value = newValue;
    
    // Set cursor position after emoji
    const newCursorPosition = cursorPosition + emoji.length;
    inputField.setSelectionRange(newCursorPosition, newCursorPosition);
    
    // Focus back to input
    inputField.focus();
    
    // Add haptic feedback on mobile
    if (window.innerWidth <= 768 && navigator.vibrate) {
        navigator.vibrate(30);
    }
    
    // Don't close picker on mobile (allow multiple emojis)
    if (window.innerWidth > 768) {
        closeEmojiPicker();
    }
}

// Tab Switching Functions
function switchEmojiTab(tabName) {
    // Hide all tabs
    document.querySelectorAll('.emoji-tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.emoji-tab').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab
    document.getElementById(tabName + 'Tab').classList.add('active');
    
    // Add active class to selected tab button
    document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
    
    // Add haptic feedback on mobile
    if (window.innerWidth <= 768 && navigator.vibrate) {
        navigator.vibrate(20);
    }
}

// GIF Functions
function searchGifs(query) {
    const gifGrid = document.getElementById('gifGrid');
    const gifLoading = document.getElementById('gifLoading');
    
    if (query.length < 2) {
        // Show popular GIFs if query is too short
        showPopularGifs();
        return;
    }
    
    // Show loading
    gifLoading.style.display = 'flex';
    gifGrid.style.display = 'none';
    
    // Simulate GIF search (in real app, you'd use Giphy API)
    setTimeout(() => {
        const mockGifs = [
            { url: 'https://media.giphy.com/media/3o7TKUM1IgqFOpVWfo/giphy.gif', thumb: 'https://media.giphy.com/media/3o7TKUM1IgqFOpVWfo/giphy.gif' },
            { url: 'https://media.giphy.com/media/l0ExayQDz5Ia0a8TS/giphy.gif', thumb: 'https://media.giphy.com/media/l0ExayQDz5Ia0a8TS/giphy.gif' },
            { url: 'https://media.giphy.com/media/3o7aD2saalBwwftBIY/giphy.gif', thumb: 'https://media.giphy.com/media/3o7aD2saalBwwftBIY/giphy.gif' }
        ];
        
        const gifHtml = mockGifs.map(gif => `
            <div class="gif-item" onclick="sendGif('${gif.url}')">
                <img src="${gif.thumb}" alt="GIF" loading="lazy">
            </div>
        `).join('');
        
        gifGrid.innerHTML = gifHtml;
        gifLoading.style.display = 'none';
        gifGrid.style.display = 'grid';
    }, 500);
}

function showPopularGifs() {
    const gifLoading = document.getElementById('gifLoading');
    gifLoading.style.display = 'none';
    document.getElementById('gifGrid').style.display = 'grid';
}

function sendGif(gifUrl) {
    const inputField = document.getElementById('msg');
    const currentValue = inputField.value;
    const cursorPosition = inputField.selectionStart;
    
    // Insert GIF URL at cursor position
    const gifText = `[GIF: ${gifUrl}]`;
    const newValue = currentValue.slice(0, cursorPosition) + gifText + currentValue.slice(cursorPosition);
    inputField.value = newValue;
    
    // Set cursor position after GIF
    const newCursorPosition = cursorPosition + gifText.length;
    inputField.setSelectionRange(newCursorPosition, newCursorPosition);
    
    // Focus back to input
    inputField.focus();
    
    // Add haptic feedback on mobile
    if (window.innerWidth <= 768 && navigator.vibrate) {
        navigator.vibrate(40);
    }
    
    // Close picker
    closeEmojiPicker();
    
    showNotification('GIF added to message');
}

// Sticker Functions
function sendSticker(sticker) {
    const inputField = document.getElementById('msg');
    const currentValue = inputField.value;
    const cursorPosition = inputField.selectionStart;
    
    // Insert only sticker emoji at cursor position
    const newValue = currentValue.slice(0, cursorPosition) + sticker + currentValue.slice(cursorPosition);
    inputField.value = newValue;
    
    // Set cursor position after sticker
    const newCursorPosition = cursorPosition + sticker.length;
    inputField.setSelectionRange(newCursorPosition, newCursorPosition);
    
    // Focus back to input
    inputField.focus();
    
    // Add haptic feedback on mobile
    if (window.innerWidth <= 768 && navigator.vibrate) {
        navigator.vibrate(40);
    }
    
    // Close picker
    closeEmojiPicker();
    
    showNotification('Sticker added to message');
}

function send(){
    let message = document.getElementById('msg').value;
    if(!message) return;

    // Prepare message data with reply info
    const messageData = {
        message: message,
        receiver_id: receiver_id
    };
    
    // Add reply information if replying
    if (replyingToMessageId) {
        messageData.reply_to_id = replyingToMessageId;
        messageData.reply_to_content = replyingToContent;
    }

    axios.post('/send', messageData).then(res=>{
        if (res.data) {
            document.getElementById('messages').innerHTML += renderMsg(res.data);
            document.getElementById('msg').value='';
            cancelReply(); // Cancel reply after sending
            scrollBottom();
        }
    }).catch(error => {
        console.warn('Error sending message:', error);
        alert('Failed to send message. Please try again.');
    });
}

// Image Functions
function handleImageUpload(event) {
    const file = event.target.files[0];
    if (!file) return;
    
    if (!receiver_id) {
        showNotification('Please select a chat first');
        return;
    }
    
    // Validate file
    if (!file.type.startsWith('image/')) {
        showNotification('Please select an image file');
        return;
    }
    
    if (file.size > 2 * 1024 * 1024) { // 2MB limit
        showNotification('Image size must be less than 2MB');
        return;
    }
    
    const formData = new FormData();
    formData.append('image', file);
    formData.append('receiver_id', receiver_id);
    
    // Add reply information if replying
    if (replyingToMessageId) {
        formData.append('reply_to_id', replyingToMessageId);
        formData.append('reply_to_content', replyingToContent);
    }
    
    // Show loading state
    const loadingId = showImageLoading();
    
    axios.post('/send-image', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then(res => {
        if (res.data) {
            document.getElementById('messages').innerHTML += renderMsg(res.data);
            cancelReply(); // Cancel reply after sending
            scrollBottom();
            showNotification('Image sent successfully');
        }
    }).catch(error => {
        console.warn('Error sending image:', error);
        showNotification('Failed to send image. Please try again.');
    }).finally(() => {
        removeImageLoading(loadingId);
        // Clear file input
        event.target.value = '';
    });
}

function showImageLoading() {
    const messagesContainer = document.getElementById('messages');
    const loadingId = 'img-loading-' + Date.now();
    
    const loadingHtml = `
        <div class="message me" id="${loadingId}">
            <div class="msg-content">
                <div class="msg-image-loading">Loading image...</div>
            </div>
        </div>
    `;
    
    messagesContainer.innerHTML += loadingHtml;
    scrollBottom();
    
    return loadingId;
}

function removeImageLoading(loadingId) {
    const loadingElement = document.getElementById(loadingId);
    if (loadingElement) {
        loadingElement.remove();
    }
}

function handleAudioUpload(event) {
    const file = event.target.files[0];
    if (!file) return;
    
    if (!receiver_id) {
        showNotification('Please select a chat first');
        return;
    }
    
    // Validate file
    if (!file.type.startsWith('audio/')) {
        showNotification('Please select an audio file');
        return;
    }
    
    if (file.size > 10 * 1024 * 1024) { // 10MB limit
        showNotification('Audio size must be less than 10MB');
        return;
    }
    
    const formData = new FormData();
    formData.append('audio', file);
    formData.append('receiver_id', receiver_id);
    
    // Add reply information if replying
    if (replyingToMessageId) {
        formData.append('reply_to_id', replyingToMessageId);
        formData.append('reply_to_content', replyingToContent);
    }
    
    // Show loading state
    const loadingId = showAudioLoading();
    
    axios.post('/send-audio', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then(res => {
        if (res.data) {
            document.getElementById('messages').innerHTML += renderMsg(res.data);
            cancelReply(); // Cancel reply after sending
            scrollBottom();
            showNotification('Audio sent successfully');
        }
    }).catch(error => {
        console.warn('Error sending audio:', error);
        showNotification('Failed to send audio. Please try again.');
    }).finally(() => {
        removeAudioLoading(loadingId);
        // Clear file input
        event.target.value = '';
    });
}

function showAudioLoading() {
    const messagesContainer = document.getElementById('messages');
    const loadingId = 'audio-loading-' + Date.now();
    
    const loadingHtml = `
        <div class="message me" id="${loadingId}">
            <div class="msg-content">
                <div class="msg-audio-loading">
                    🎙️ Sending audio...
                </div>
            </div>
        </div>
    `;
    
    messagesContainer.innerHTML += loadingHtml;
    scrollBottom();
    
    return loadingId;
}

function removeAudioLoading(loadingId) {
    const loadingElement = document.getElementById(loadingId);
    if (loadingElement) {
        loadingElement.remove();
    }
}

let currentAudio = null;
let currentAudioElement = null;

function toggleAudioPlayback(audioPath, audioElement) {
    // Stop current audio if playing
    if (currentAudio && currentAudioElement !== audioElement) {
        currentAudio.pause();
        currentAudioElement.querySelector('.audio-play-btn').textContent = '▶️';
        currentAudioElement.querySelector('.audio-icon').textContent = '🎙️';
    }
    
    const playBtn = audioElement.querySelector('.audio-play-btn');
    const audioIcon = audioElement.querySelector('.audio-icon');
    
    if (currentAudioElement === audioElement && currentAudio && !currentAudio.paused) {
        // Pause current audio
        currentAudio.pause();
        playBtn.textContent = '▶️';
        audioIcon.textContent = '🎙️';
        currentAudio = null;
        currentAudioElement = null;
    } else {
        // Play new audio
        const audio = new Audio('/storage/' + audioPath);
        
        audio.addEventListener('loadedmetadata', function() {
            const duration = audio.duration;
            const minutes = Math.floor(duration / 60);
            const seconds = Math.floor(duration % 60);
            const durationText = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            const durationElement = audioElement.querySelector('.audio-duration');
            if (durationElement) {
                durationElement.textContent = durationText;
            }
        });
        
        audio.addEventListener('ended', function() {
            playBtn.textContent = '▶️';
            audioIcon.textContent = '🎙️';
            currentAudio = null;
            currentAudioElement = null;
        });
        
        audio.play();
        playBtn.textContent = '⏸️';
        audioIcon.textContent = '🔊';
        currentAudio = audio;
        currentAudioElement = audioElement;
    }
}

function openImageViewer(imageSrc) {
    const viewer = document.getElementById('imageViewer');
    const content = document.getElementById('imageViewerContent');
    const loading = document.getElementById('imageViewerLoading');
    
    // Show viewer
    viewer.classList.add('show');
    
    // Show loading
    loading.style.display = 'block';
    content.style.display = 'none';
    
    // Load image
    const img = new Image();
    img.onload = function() {
        loading.style.display = 'none';
        content.src = imageSrc;
        content.style.display = 'block';
    };
    img.onerror = function() {
        loading.style.display = 'none';
        showNotification('Failed to load image');
        closeImageViewer();
    };
    img.src = imageSrc;
    
    // Add haptic feedback on mobile
    if (window.innerWidth <= 768 && navigator.vibrate) {
        navigator.vibrate(30);
    }
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeImageViewer() {
    const viewer = document.getElementById('imageViewer');
    const content = document.getElementById('imageViewerContent');
    const loading = document.getElementById('imageViewerLoading');
    
    viewer.classList.remove('show');
    content.src = '';
    content.style.display = 'none';
    loading.style.display = 'none';
    
    // Restore body scroll
    document.body.style.overflow = '';
    
    // Add haptic feedback on mobile
    if (window.innerWidth <= 768 && navigator.vibrate) {
        navigator.vibrate(20);
    }
}

// Close image viewer on escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeImageViewer();
    }
});

// Close image viewer on background click
document.getElementById('imageViewer').addEventListener('click', function(event) {
    if (event.target === this) {
        closeImageViewer();
    }
});

// Delete and Clear Chat Functions
function deleteMessage(messageId) {
    if (!confirm('Are you sure you want to delete this message?')) {
        return;
    }
    
    axios.delete(`/delete-message/${messageId}`)
        .then(response => {
            if (response.data.success) {
                // Remove message from DOM
                const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
                if (messageElement) {
                    messageElement.remove();
                    showNotification('Message deleted successfully');
                }
            }
        })
        .catch(error => {
            console.warn('Error deleting message:', error);
            showNotification('Failed to delete message');
        });
}

function clearChat(userId) {
    if (!confirm('Are you sure you want to clear all messages with this user? This action cannot be undone.')) {
        return;
    }
    
    axios.delete(`/clear-chat/${userId}`)
        .then(response => {
            if (response.data.success) {
                // Clear all messages from DOM
                const messagesContainer = document.getElementById('messages');
                if (messagesContainer) {
                    messagesContainer.innerHTML = '';
                    showNotification('Chat cleared successfully');
                }
            }
        })
        .catch(error => {
            console.warn('Error clearing chat:', error);
            showNotification('Failed to clear chat');
        });
}

// Add delete and clear chat buttons to context menu
function updateContextMenuWithDeleteOptions() {
    // This will be called when context menu is shown
    const contextMenu = document.getElementById('contextMenu');
    if (contextMenu) {
        // Add delete message option
        const deleteOption = document.createElement('div');
        deleteOption.className = 'context-menu-item';
        deleteOption.innerHTML = '🗑️ Delete Message';
        deleteOption.onclick = function() {
            const messageId = contextMenu.dataset.messageId;
            deleteMessage(messageId);
            closeContextMenu();
        };
        
        // Add clear chat option
        const clearOption = document.createElement('div');
        clearOption.className = 'context-menu-item';
        clearOption.innerHTML = '🧹 Clear Chat';
        clearOption.onclick = function() {
            const userId = contextMenu.dataset.userId;
            clearChat(userId);
            closeContextMenu();
        };
        
        contextMenu.appendChild(deleteOption);
        contextMenu.appendChild(clearOption);
    }
}

function handleKeyPress(event){
    // Send message on Enter key (but not with Shift+Enter for new lines)
    if(event.key === 'Enter' && !event.shiftKey){
        event.preventDefault(); // Prevent new line
        send();
    }
}

function sendImage(){
    let file=document.getElementById('img').files[0];
    if(!file) return;
    
    let form=new FormData();
    form.append('image',file);
    form.append('receiver_id',receiver_id);

    axios.post('/send-image',form).then(res=>{
        if (res.data) {
            document.getElementById('messages').innerHTML += renderMsg(res.data);
            scrollBottom();
        }
    }).catch(error => {
        console.warn('Error sending image:', error);
        alert('Failed to send image. Please try again.');
    });
    
    // Clear file input
    document.getElementById('img').value = '';
}

function scrollBottom(){
    let box = document.getElementById('messages');
    box.scrollTop = box.scrollHeight;
}

// TYPING INDICATOR
document.getElementById('msg').addEventListener('input', ()=>{
    if(receiver_id && document.getElementById('msg').value){
        axios.post('/typing',{receiver_id}).catch(error => {
            // Silently handle typing indicator errors
            console.warn('Typing indicator error:', error);
        });
    }
});

// SIMPLE REALTIME SYSTEM (Polling-based)
let lastMessageId = 0;

function checkNewMessages() {
    if (!receiver_id) return;
    
    axios.get('/messages/' + receiver_id).then(res => {
        // Check if response data exists and is an array
        if (!res.data || !Array.isArray(res.data)) {
            return;
        }
        
        const newMessages = res.data.filter(m => m && m.id > lastMessageId);
        
        if (newMessages.length > 0) {
            newMessages.forEach(msg => {
                // Only show messages from other users (received messages)
                if (msg.sender_id != {{ auth()->id() }}) {
                    document.getElementById('messages').innerHTML += renderMsg(msg);
                    document.getElementById('tone').play();
                }
            });
            
            // Update last message ID safely
            const validMessages = res.data.filter(m => m && m.id);
            if (validMessages.length > 0) {
                lastMessageId = Math.max(...validMessages.map(m => m.id));
            }
            
            scrollBottom();
        }
    }).catch(error => {
        // Silently handle errors to prevent console spam
        console.warn('Error checking messages:', error);
    });
}

// Poll for new messages every 2 seconds
setInterval(checkNewMessages, 2000);

// ENHANCED TYPING INDICATOR
let typingTimeout;

function showTypingIndicator() {
    if (!receiver_id) return;
    
    const typingElement = document.getElementById('typing');
    typingElement.style.display = 'flex';
    
    clearTimeout(typingTimeout);
    typingTimeout = setTimeout(() => {
        typingElement.style.display = 'none';
    }, 3000);
}

// Hide typing indicator initially
document.getElementById('typing').style.display = 'none';

// MOBILE BOTTOM NAVIGATION FUNCTIONS
function showChatScreen() {
    // Show sidebar, hide chat
    const chatElement = document.getElementById('chat');
    chatElement.classList.remove('active', 'updates-screen', 'profile-screen');
    document.getElementById('mobileBottomNav').classList.remove('hide');
    
    // Show input bar when returning to chat screen
    const inputContainer = document.querySelector('.input-container');
    if (inputContainer) {
        inputContainer.style.display = 'block';
    }
    
    // Hide navigation menu on chat screen
    const chatActions = document.querySelector('.chat-actions');
    if (chatActions) {
        chatActions.style.display = 'none';
    }
    
    // Stop automatic message refresh when returning to user list
    stopMessageRefresh();
    receiver_id = null;
    
    // Update active nav item
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });
    event.target.closest('.nav-item').classList.add('active');
}

function showUpdatesScreen() {
    // Stop automatic message refresh when switching screens
    stopMessageRefresh();
    receiver_id = null;
    
    // Show stories and updates
    const messagesDiv = document.getElementById('messages');
    messagesDiv.innerHTML = `
        <div style="padding:20px;">
            <!-- Stories Section -->
            <div style="margin-bottom:30px;">
                <h4 style="color:#f0f2f5;margin-bottom:15px;font-size:16px;">📸 Status</h4>
                <div style="display:flex;gap:15px;overflow-x:auto;padding-bottom:10px;">
                    <div style="text-align:center;min-width:70px;cursor:pointer;" onclick="addStory()">
                        <div style="width:60px;height:60px;border-radius:50%;background:#25D366;display:flex;align-items:center;justify-content:center;margin-bottom:5px;border:2px solid #111b21;">
                            <span style="color:#111b21;font-size:24px;">+</span>
                        </div>
                        <div style="color:#8696a0;font-size:12px;">Your story</div>
                    </div>
                    <div style="text-align:center;min-width:70px;cursor:pointer;" onclick="viewUserStory('User 1', 'photo', 'https://picsum.photos/seed/story1/400/600.jpg')">
                        <div style="width:60px;height:60px;border-radius:50%;background:#2a3942;display:flex;align-items:center;justify-content:center;margin-bottom:5px;border:2px solid #25D366;">
                            <span style="color:#f0f2f5;font-size:16px;">👤</span>
                        </div>
                        <div style="color:#8696a0;font-size:12px;">User 1</div>
                    </div>
                    <div style="text-align:center;min-width:70px;cursor:pointer;" onclick="viewUserStory('User 2', 'text', 'Having an amazing day! ☀️')">
                        <div style="width:60px;height:60px;border-radius:50%;background:#2a3942;display:flex;align-items:center;justify-content:center;margin-bottom:5px;border:2px solid #25D366;">
                            <span style="color:#f0f2f5;font-size:16px;">👤</span>
                        </div>
                        <div style="color:#8696a0;font-size:12px;">User 2</div>
                    </div>
                </div>
            </div>
            
            <!-- Updates Section -->
            <div>
                <h4 style="color:#f0f2f5;margin-bottom:15px;font-size:16px;">🔄 Recent Updates</h4>
                <div style="background:#202c33;border-radius:10px;padding:15px;margin-bottom:10px;">
                    <div style="color:#25D366;font-size:12px;margin-bottom:5px;">2 hours ago</div>
                    <div style="color:#f0f2f5;">New message encryption feature added</div>
                </div>
                <div style="background:#202c33;border-radius:10px;padding:15px;margin-bottom:10px;">
                    <div style="color:#25D366;font-size:12px;margin-bottom:5px;">1 day ago</div>
                    <div style="color:#f0f2f5;">Voice messages now available</div>
                </div>
                <div style="background:#202c33;border-radius:10px;padding:15px;">
                    <div style="color:#25D366;font-size:12px;margin-bottom:5px;">2 days ago</div>
                    <div style="color:#f0f2f5;">Video calls feature launched</div>
                </div>
            </div>
        </div>
    `;
    
    // Show chat screen with updates
    document.getElementById('chatName').innerText = 'Updates';
    document.getElementById('chatAvatar').innerText = '📱';
    document.getElementById('chat').classList.add('active', 'updates-screen');
    document.getElementById('mobileBottomNav').classList.remove('hide');
    
    // Hide input bar on Updates screen
    const inputContainer = document.querySelector('.input-container');
    if (inputContainer) {
        inputContainer.style.display = 'none';
    }
    
    // Show navigation menu on Updates screen
    const chatActions = document.querySelector('.chat-actions');
    if (chatActions) {
        chatActions.style.display = 'flex';
    }
    
    // Update active nav item
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });
    event.target.closest('.nav-item').classList.add('active');
    
    // Clear updates badge
    updateUpdatesBadge(0);
}

function showProfileScreen() {
    // Stop automatic message refresh when switching screens
    stopMessageRefresh();
    receiver_id = null;
    
    // For now, just show a message
    const messagesDiv = document.getElementById('messages');
    messagesDiv.innerHTML = `
        <div style="padding:20px;max-width:600px;margin:0 auto;">
            <!-- Profile Header -->
            <div style="text-align:center;margin-bottom:30px;">
                <div style="position:relative;display:inline-block;">
                    <div id="profileImageContainer" style="width:120px;height:120px;border-radius:50%;background:#2a3942;display:flex;align-items:center;justify-content:center;margin:0 auto 15px;cursor:pointer;border:3px solid #25D366;overflow:hidden;" onclick="document.getElementById('profileImageInput').click()">
                        <img id="profileImage" src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : '' }}" style="width:100%;height:100%;object-fit:cover;{{ auth()->user()->avatar ? '' : 'display:none;' }}" alt="Profile">
                        <span id="profilePlaceholder" style="color:#8696a0;font-size:40px;{{ auth()->user()->avatar ? 'display:none;' : '' }}"><i class="fas fa-user"></i></span>
                    </div>
                    <button onclick="document.getElementById('profileImageInput').click()" style="position:absolute;bottom:5px;right:5px;background:#25D366;border:none;border-radius:50%;width:30px;height:30px;color:white;cursor:pointer;font-size:12px;"><i class="fas fa-camera"></i></button>
                    <input type="file" id="profileImageInput" accept="image/*" style="display:none;" onchange="handleProfileImageUpload(event)">
                </div>
                <h2 style="color:#f0f2f5;margin:10px 0;">My Profile</h2>
            </div>
            
            <!-- Profile Menu -->
            <div style="background:#202c33;border-radius:15px;padding:20px;margin-bottom:20px;">
                <div style="color:#25D366;font-size:14px;font-weight:600;margin-bottom:15px;">Profile Settings</div>
                
                <div style="display:flex;flex-direction:column;gap:15px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:15px 0;border-bottom:1px solid #2a3942;cursor:pointer;" onclick="editProfileInfo('name')">
                        <div style="display:flex;align-items:center;gap:15px;">
                            <span style="color:#8696a0;font-size:16px;"><i class="fas fa-user"></i></span>
                            <div>
                                <div style="color:#f0f2f5;font-size:14px;">Name</div>
                                <div id="profileName" style="color:#8696a0;font-size:12px;">{{ auth()->user()->name }}</div>
                            </div>
                        </div>
                        <span style="color:#8696a0;"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:15px 0;border-bottom:1px solid #2a3942;cursor:pointer;" onclick="editProfileInfo('about')">
                        <div style="display:flex;align-items:center;gap:15px;">
                            <span style="color:#8696a0;font-size:16px;"><i class="fas fa-pen"></i></span>
                            <div>
                                <div style="color:#f0f2f5;font-size:14px;">About</div>
                                <div id="profileAbout" style="color:#8696a0;font-size:12px;">{{ auth()->user()->bio ?: 'Hey there! I am using Support Chat.' }}</div>
                            </div>
                        </div>
                        <span style="color:#8696a0;"><i class="fas fa-chevron-right"></i></span>
                    </div>
                    
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:15px 0;border-bottom:1px solid #2a3942;cursor:pointer;" onclick="editProfileInfo('phone')">
                        <div style="display:flex;align-items:center;gap:15px;">
                            <span style="color:#8696a0;font-size:16px;"><i class="fas fa-phone"></i></span>
                            <div>
                                <div style="color:#f0f2f5;font-size:14px;">Phone</div>
                                <div id="profilePhone" style="color:#8696a0;font-size:12px;">{{ auth()->user()->phone ?: 'Not set' }}</div>
                            </div>
                        </div>
                        <span style="color:#8696a0;"><i class="fas fa-chevron-right"></i></span>
                    </div>
                </div>
            </div>
            
            <!-- Additional Options -->
            <div style="background:#202c33;border-radius:15px;padding:20px;">
                <div style="color:#25D366;font-size:14px;font-weight:600;margin-bottom:15px;">Account Settings</div>
                
                <div style="display:flex;flex-direction:column;gap:15px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:15px 0;border-bottom:1px solid #2a3942;cursor:pointer;" onclick="showSettings('privacy')">
                        <div style="display:flex;align-items:center;gap:15px;">
                            <span style="color:#8696a0;font-size:16px;">🔒</span>
                            <div>
                                <div style="color:#f0f2f5;font-size:14px;">Privacy</div>
                                <div style="color:#8696a0;font-size:12px;">Control your privacy</div>
                            </div>
                        </div>
                        <span style="color:#8696a0;">›</span>
                    </div>
                    
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:15px 0;border-bottom:1px solid #2a3942;cursor:pointer;" onclick="showSettings('security')">
                        <div style="display:flex;align-items:center;gap:15px;">
                            <span style="color:#8696a0;font-size:16px;">🛡️</span>
                            <div>
                                <div style="color:#f0f2f5;font-size:14px;">Security</div>
                                <div style="color:#8696a0;font-size:12px;">Two-step verification</div>
                            </div>
                        </div>
                        <span style="color:#8696a0;">›</span>
                    </div>
                    
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:15px 0;cursor:pointer;" onclick="showSettings('notifications')">
                        <div style="display:flex;align-items:center;gap:15px;">
                            <span style="color:#8696a0;font-size:16px;">🔔</span>
                            <div>
                                <div style="color:#f0f2f5;font-size:14px;">Notifications</div>
                                <div style="color:#8696a0;font-size:12px;">Message, group & call tones</div>
                            </div>
                        </div>
                        <span style="color:#8696a0;">›</span>
                    </div>
                    
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:15px 0;cursor:pointer;" onclick="showSettings('storage')">
                        <div style="display:flex;align-items:center;gap:15px;">
                            <span style="color:#8696a0;font-size:16px;">💾</span>
                            <div>
                                <div style="color:#f0f2f5;font-size:14px;">Storage</div>
                                <div style="color:#8696a0;font-size:12px;">Network usage</div>
                            </div>
                        </div>
                        <span style="color:#8696a0;">›</span>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div style="text-align:center;margin-top:30px;">
                <button onclick="saveProfile()" style="background:#25D366;color:white;border:none;padding:12px 30px;border-radius:25px;font-size:16px;cursor:pointer;margin:0 10px;">Save Changes</button>
                <button onclick="logout()" style="background:#dc3545;color:white;border:none;padding:12px 30px;border-radius:25px;font-size:16px;cursor:pointer;margin:0 10px;">Logout</button>
            </div>
        </div>
    `;
    
    // Show chat screen with profile
    document.getElementById('chatName').innerText = 'Profile';
    document.getElementById('chatAvatar').innerText = '👤';
    document.getElementById('chat').classList.add('active', 'profile-screen');
    document.getElementById('mobileBottomNav').classList.remove('hide');
    
    // Hide input bar on Profile screen
    const inputContainer = document.querySelector('.input-container');
    if (inputContainer) {
        inputContainer.style.display = 'none';
    }
    
    // Show navigation menu on Profile screen
    const chatActions = document.querySelector('.chat-actions');
    if (chatActions) {
        chatActions.style.display = 'flex';
    }
    
    // Update active nav item
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });
    event.target.closest('.nav-item').classList.add('active');
}

// Update goBack function to show bottom nav
function goBack(){
    document.getElementById('chat').classList.remove('active');
    document.getElementById('mobileBottomNav').classList.remove('hide');
    
    // Reset active nav to Chat
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });
    document.querySelector('.nav-item').classList.add('active');
    
    // Clear chat badge when returning to chat list
    updateChatBadge(0);
}

// Function to update chat badge
function updateChatBadge(count) {
    const badge = document.getElementById('chatBadge');
    if (count > 0) {
        badge.textContent = count > 99 ? '99+' : count;
        badge.style.display = 'block';
    } else {
        badge.style.display = 'none';
    }
}

// Track unread messages and updates
let unreadCount = 0;
let updatesCount = 0;

// Function to update updates badge
function updateUpdatesBadge(count) {
    const badge = document.getElementById('updatesBadge');
    if (count > 0) {
        badge.textContent = count > 99 ? '99+' : count;
        badge.style.display = 'block';
    } else {
        badge.style.display = 'none';
    }
}

// Function to add story
function addStory() {
    // Show story upload popup
    document.getElementById('storyPopup').style.display = 'block';
}

function closeStoryPopup() {
    document.getElementById('storyPopup').style.display = 'none';
    // Reset form
    resetStoryForm();
}

function resetStoryForm() {
    // Reset story type
    document.getElementById('storyType').value = 'photo';
    updateStoryOptions();
    
    // Clear inputs
    document.getElementById('storyPhotoInput').value = '';
    document.getElementById('storyVideoInput').value = '';
    document.getElementById('storyText').value = '';
    document.getElementById('textCount').innerText = '0';
    
    // Reset previews
    document.getElementById('storyPhotoPreview').style.display = 'none';
    document.getElementById('storyPhotoPlaceholder').style.display = 'block';
    document.getElementById('storyVideoPreview').style.display = 'none';
    document.getElementById('storyVideoPlaceholder').style.display = 'block';
    
    // Reset duration
    document.getElementById('storyDuration').value = '24';
    
    // Reset privacy
    document.getElementById('storyPrivacy').checked = true;
}

function updateStoryOptions() {
    const storyType = document.getElementById('storyType').value;
    
    // Hide all groups
    document.getElementById('photoUploadGroup').style.display = 'none';
    document.getElementById('videoUploadGroup').style.display = 'none';
    document.getElementById('textStoryGroup').style.display = 'none';
    
    // Show relevant group
    switch(storyType) {
        case 'photo':
            document.getElementById('photoUploadGroup').style.display = 'block';
            break;
        case 'video':
            document.getElementById('videoUploadGroup').style.display = 'block';
            break;
        case 'text':
            document.getElementById('textStoryGroup').style.display = 'block';
            break;
    }
}

function previewStoryPhoto(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('storyPreviewImg').src = e.target.result;
            document.getElementById('storyPhotoPreview').style.display = 'block';
            document.getElementById('storyPhotoPlaceholder').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}

function previewStoryVideo(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('video/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('storyPreviewVideo').src = e.target.result;
            document.getElementById('storyVideoPreview').style.display = 'block';
            document.getElementById('storyVideoPlaceholder').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}

// Text character counter
document.addEventListener('DOMContentLoaded', function() {
    const storyText = document.getElementById('storyText');
    if (storyText) {
        storyText.addEventListener('input', function() {
            const textCount = document.getElementById('textCount');
            if (textCount) {
                textCount.innerText = this.value.length;
            }
        });
    }
});

function uploadStory() {
    const storyType = document.getElementById('storyType').value;
    const duration = document.getElementById('storyDuration').value;
    const privacy = document.getElementById('storyPrivacy').checked;
    
    let storyData = {
        type: storyType,
        duration: duration,
        privacy: privacy,
        timestamp: new Date().toISOString()
    };
    
    // Collect data based on story type
    switch(storyType) {
        case 'photo':
            const photoInput = document.getElementById('storyPhotoInput');
            if (photoInput.files.length > 0) {
                storyData.fileName = photoInput.files[0].name;
                storyData.fileSize = photoInput.files[0].size;
            } else {
                alert('Please select a photo to upload.');
                return;
            }
            break;
            
        case 'video':
            const videoInput = document.getElementById('storyVideoInput');
            if (videoInput.files.length > 0) {
                storyData.fileName = videoInput.files[0].name;
                storyData.fileSize = videoInput.files[0].size;
            } else {
                alert('Please select a video to upload.');
                return;
            }
            break;
            
        case 'text':
            const textContent = document.getElementById('storyText').value.trim();
            if (textContent === '') {
                alert('Please enter text for your story.');
                return;
            }
            storyData.content = textContent;
            break;
    }
    
    // Show loading state
    const popupContent = document.querySelector('#storyPopup .profile-popup-content > div:last-child');
    popupContent.innerHTML = `
        <div style="text-align:center;padding:40px 20px;">
            <div style="width:60px;height:60px;border-radius:50%;background:#25D366;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;animation:spin 1s linear infinite;">
                <span style="color:white;font-size:24px;">⏳</span>
            </div>
            <h3 style="color:#f0f2f5;margin-bottom:10px;">Uploading Story...</h3>
            <p style="color:#8696a0;font-size:14px;">Please wait while we upload your story.</p>
        </div>
    `;
    
    // Simulate upload process
    setTimeout(() => {
        closeStoryPopup();
        alert('Story uploaded successfully!\n\nYour story will be visible for ' + duration + ' hours.\n\nData: ' + JSON.stringify(storyData, null, 2));
        
        // Update stories badge
        updatesCount++;
        updateUpdatesBadge(updatesCount);
    }, 2000);
}

// Story viewer functions
let storyProgressInterval;

function viewUserStory(userName, storyType, storyContent) {
    // Update story header
    document.getElementById('storyUserName').innerText = userName;
    document.getElementById('storyUserAvatar').querySelector('span').innerText = userName.charAt(0).toUpperCase();
    document.getElementById('storyTime').innerText = '2 hours ago';
    
    // Hide all story content types
    document.getElementById('photoStoryContent').style.display = 'none';
    document.getElementById('videoStoryContent').style.display = 'none';
    document.getElementById('textStoryContent').style.display = 'none';
    document.getElementById('defaultStoryContent').style.display = 'none';
    
    // Show relevant content based on story type
    switch(storyType) {
        case 'photo':
            document.getElementById('photoStoryContent').style.display = 'block';
            document.getElementById('storyPhoto').src = storyContent;
            break;
            
        case 'video':
            document.getElementById('videoStoryContent').style.display = 'block';
            document.getElementById('storyVideo').src = storyContent;
            break;
            
        case 'text':
            document.getElementById('textStoryContent').style.display = 'block';
            document.getElementById('storyTextContent').innerText = storyContent;
            break;
    }
    
    // Hide delete button for other users' stories
    document.getElementById('deleteStoryBtn').style.display = 'none';
    
    // Initialize story stats and reactions
    initializeStoryStats(userName);
    
    // Show story viewer popup
    document.getElementById('storyViewerPopup').style.display = 'block';
    
    // Start story progress animation
    startStoryProgress();
}

function initializeStoryStats(userName) {
    // Reset reactions for new story
    storyReactions = {};
    
    // Set initial views (simulate different view counts for different users)
    storyViews = Math.floor(Math.random() * 50) + 10;
    
    // Add some initial reactions (simulate existing reactions)
    const initialReactions = ['❤️', '😂', '🔥'];
    initialReactions.forEach(emoji => {
        if (Math.random() > 0.5) {
            storyReactions[emoji] = Math.floor(Math.random() * 5) + 1;
        }
    });
    
    // Update displays
    updateStoryStats();
    updateReactionsDisplay();
    
    // Reset reply input
    document.getElementById('storyReplyInput').value = '';
    document.getElementById('storyReplySection').style.display = 'none';
}

function closeStoryViewer() {
    // Clear progress interval
    if (storyProgressInterval) {
        clearInterval(storyProgressInterval);
    }
    
    // Reset progress
    document.getElementById('storyProgress').style.width = '0%';
    
    // Hide popup
    document.getElementById('storyViewerPopup').style.display = 'none';
    
    // Stop video if playing
    const video = document.getElementById('storyVideo');
    if (video) {
        video.pause();
        video.currentTime = 0;
    }
}

function startStoryProgress() {
    let progress = 0;
    const progressBar = document.getElementById('storyProgress');
    
    // Clear any existing interval
    if (storyProgressInterval) {
        clearInterval(storyProgressInterval);
    }
    
    // Start new progress animation (10 seconds total)
    storyProgressInterval = setInterval(() => {
        progress += 1;
        progressBar.style.width = progress + '%';
        
        if (progress >= 100) {
            clearInterval(storyProgressInterval);
            closeStoryViewer();
        }
    }, 100); // Update every 100ms for smooth animation
}

// Enhanced story interaction functions
let storyReactions = {};
let storyViews = 23;

function toggleStoryReply() {
    const replySection = document.getElementById('storyReplySection');
    const replyInput = document.getElementById('storyReplyInput');
    
    if (replySection.style.display === 'none') {
        replySection.style.display = 'block';
        replyInput.focus();
    } else {
        replySection.style.display = 'none';
        replyInput.value = '';
    }
}

function handleStoryReplyKeypress(event) {
    if (event.key === 'Enter') {
        sendStoryReply();
    }
}

function sendStoryReply() {
    const replyInput = document.getElementById('storyReplyInput');
    const replyText = replyInput.value.trim();
    
    if (replyText === '') {
        return;
    }
    
    const userName = document.getElementById('storyUserName').innerText;
    
    // Simulate sending reply
    alert('Reply sent to ' + userName + ':\n"' + replyText + '"\n\nThis would open a chat and send the message.');
    
    // Clear input and hide reply section
    replyInput.value = '';
    document.getElementById('storyReplySection').style.display = 'none';
    
    // Update story stats
    updateStoryStats();
}

function reactToStory(emoji) {
    const userName = document.getElementById('storyUserName').innerText;
    
    // Track reactions
    if (!storyReactions[emoji]) {
        storyReactions[emoji] = 0;
    }
    storyReactions[emoji]++;
    
    // Show reaction animation
    showReactionAnimation(emoji);
    
    // Update reactions display
    updateReactionsDisplay();
    
    // Simulate sending reaction
    console.log('Reaction sent to ' + userName + '\'s story: ' + emoji);
}

function showReactionAnimation(emoji) {
    // Create floating emoji animation
    const reaction = document.createElement('div');
    reaction.innerHTML = emoji;
    reaction.style.cssText = `
        position: absolute;
        font-size: 40px;
        animation: floatUp 2s ease-out forwards;
        pointer-events: none;
        z-index: 1000;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    `;
    
    // Add animation CSS if not exists
    if (!document.querySelector('#reactionAnimationCSS')) {
        const style = document.createElement('style');
        style.id = 'reactionAnimationCSS';
        style.textContent = `
            @keyframes floatUp {
                0% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
                100% { transform: translate(-50%, -150%) scale(1.5); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    }
    
    document.getElementById('storyViewerPopup').appendChild(reaction);
    
    // Remove element after animation
    setTimeout(() => {
        reaction.remove();
    }, 2000);
}

function updateReactionsDisplay() {
    const reactionsElement = document.getElementById('storyReactions');
    const totalReactions = Object.values(storyReactions).reduce((sum, count) => sum + count, 0);
    
    // Get most popular reaction
    let topReaction = '❤️';
    let maxCount = 0;
    for (const [emoji, count] of Object.entries(storyReactions)) {
        if (count > maxCount) {
            maxCount = count;
            topReaction = emoji;
        }
    }
    
    reactionsElement.innerHTML = `${topReaction} ${totalReactions}`;
}

function updateStoryStats() {
    // Increment views when story is viewed
    if (!storyViews) storyViews = 23;
    storyViews++;
    
    const viewsElement = document.getElementById('storyViews');
    viewsElement.innerHTML = `👁 ${storyViews} views`;
}

function replyToStory() {
    toggleStoryReply();
}

function shareStory() {
    const userName = document.getElementById('storyUserName').innerText;
    alert('Share ' + userName + '\'s story:\n\nThis would open sharing options to send the story to other contacts.');
}

function deleteStory() {
    if (confirm('Are you sure you want to delete this story?')) {
        closeStoryViewer();
        alert('Story deleted successfully!');
    }
}

// Profile management functions
function handleProfileImageUpload(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const profileImage = document.getElementById('profileImage');
            const profilePlaceholder = document.getElementById('profilePlaceholder');
            
            profileImage.src = e.target.result;
            profileImage.style.display = 'block';
            profilePlaceholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}

function editProfileInfo(field) {
    // Open popup for profile editing
    openProfilePopup();
}

function openProfilePopup() {
    // Load current values into popup
    const popupName = document.getElementById('popupProfileName');
    const popupAbout = document.getElementById('popupProfileAbout');
    const popupPhone = document.getElementById('popupProfilePhone');
    
    // Get current values from profile display
    const currentName = document.getElementById('profileName')?.innerText || popupName.value;
    const currentAbout = document.getElementById('profileAbout')?.innerText || popupAbout.value;
    const currentPhone = document.getElementById('profilePhone')?.innerText || popupPhone.value;
    
    // Set popup values
    popupName.value = currentName;
    popupAbout.value = currentAbout;
    popupPhone.value = currentPhone;
    
    // Show popup
    document.getElementById('profileEditPopup').style.display = 'block';
}

function closeProfilePopup() {
    document.getElementById('profileEditPopup').style.display = 'none';
}

// Handle form submission
document.getElementById('profileEditForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form values
    const name = document.getElementById('popupProfileName').value;
    const about = document.getElementById('popupProfileAbout').value;
    const phone = document.getElementById('popupProfilePhone').value;
    
    // Update profile display
    const profileName = document.getElementById('profileName');
    const profileAbout = document.getElementById('profileAbout');
    const profilePhone = document.getElementById('profilePhone');
    
    if (profileName) profileName.innerText = name;
    if (profileAbout) profileAbout.innerText = about;
    if (profilePhone) profilePhone.innerText = phone;
    
    // Close popup
    closeProfilePopup();
    
    // Show success message
    alert('Profile updated successfully!');
});

function showSettings(setting) {
    // Hide all settings sections
    document.querySelectorAll('#settingsContent > div').forEach(section => {
        section.style.display = 'none';
    });
    
    // Show selected settings section
    const settingsSection = document.getElementById(setting + 'Settings');
    if (settingsSection) {
        settingsSection.style.display = 'block';
    }
    
    // Update popup title
    const titleElement = document.getElementById('settingsPopupTitle');
    if (titleElement) {
        titleElement.innerText = setting.charAt(0).toUpperCase() + setting.slice(1) + ' Settings';
    }
    
    // Show settings popup
    document.getElementById('accountSettingsPopup').style.display = 'block';
}

function closeSettingsPopup() {
    document.getElementById('accountSettingsPopup').style.display = 'none';
}

function saveSettings() {
    // Collect all settings data
    const settingsData = {};
    
    // Privacy settings
    const privacySection = document.getElementById('privacySettings');
    if (privacySection && privacySection.style.display !== 'none') {
        settingsData.privacy = {
            lastSeen: privacySection.querySelector('select:nth-of-type(1)').value,
            profilePhoto: privacySection.querySelector('select:nth-of-type(2)').value,
            about: privacySection.querySelector('select:nth-of-type(3)').value,
            status: privacySection.querySelector('select:nth-of-type(4)').value
        };
    }
    
    // Security settings
    const securitySection = document.getElementById('securitySettings');
    if (securitySection && securitySection.style.display !== 'none') {
        settingsData.security = {
            twoStepVerification: 'enabled', // Would be determined by actual state
            securityNotifications: securitySection.querySelector('select').value
        };
    }
    
    // Notification settings
    const notificationsSection = document.getElementById('notificationsSettings');
    if (notificationsSection && notificationsSection.style.display !== 'none') {
        settingsData.notifications = {
            messageNotifications: notificationsSection.querySelector('select:nth-of-type(1)').value,
            groupNotifications: notificationsSection.querySelector('select:nth-of-type(2)').value,
            notificationTone: notificationsSection.querySelector('select:nth-of-type(3)').value,
            vibration: notificationsSection.querySelector('select:nth-of-type(4)').value
        };
    }
    
    // Storage settings
    const storageSection = document.getElementById('storageSettings');
    if (storageSection && storageSection.style.display !== 'none') {
        settingsData.storage = {
            cleared: true // Would be set if clear storage was clicked
        };
    }
    
    // Close popup
    closeSettingsPopup();
    
    // Show success message
    alert('Settings saved successfully!\n\nData: ' + JSON.stringify(settingsData, null, 2));
}

function saveProfile() {
    const profileData = {
        name: document.getElementById('profileName').innerText,
        about: document.getElementById('profileAbout').innerText,
        phone: document.getElementById('profilePhone').innerText,
        image: document.getElementById('profileImage').src
    };
    
    alert('Profile saved successfully!\n\nData: ' + JSON.stringify(profileData, null, 2));
}

function logout() {
    // Show logout confirmation popup
    document.getElementById('logoutPopup').style.display = 'block';
}

function closeLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'none';
}

function confirmLogout() {
    // Close popup
    closeLogoutPopup();
    
    // Show loading message
    const logoutContent = document.querySelector('#logoutPopup .profile-popup-content > div:last-child');
    logoutContent.innerHTML = `
        <div style="text-align:center;padding:40px 20px;">
            <div style="width:60px;height:60px;border-radius:50%;background:#25D366;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;animation:spin 1s linear infinite;">
                <span style="color:white;font-size:24px;">⏳</span>
            </div>
            <h3 style="color:#f0f2f5;margin-bottom:10px;">Logging out...</h3>
            <p style="color:#8696a0;font-size:14px;">Please wait while we secure your account.</p>
        </div>
    `;
    
    // Re-open popup with loading state
    document.getElementById('logoutPopup').style.display = 'block';
    
    // Simulate logout process (in real app, this would be an AJAX call)
    setTimeout(() => {
        // Redirect to logout endpoint
        window.location.href = '/logout';
    }, 2000);
}

// Automatic message refresh setup
let messageRefreshInterval;
let lastMessageCount = 0;

// Start automatic message refresh when chat is opened
function startMessageRefresh() {
    if (!receiver_id) return;
    
    // Clear any existing interval
    if (messageRefreshInterval) {
        clearInterval(messageRefreshInterval);
    }
    
    // Check messages immediately
    checkNewMessages();
    
    // Set up automatic refresh every 3 seconds
    messageRefreshInterval = setInterval(() => {
        checkNewMessages();
    }, 3000);
}

// Stop automatic message refresh when chat is closed
function stopMessageRefresh() {
    if (messageRefreshInterval) {
        clearInterval(messageRefreshInterval);
        messageRefreshInterval = null;
    }
}

// Enhanced checkNewMessages for auto-refresh
checkNewMessages = function() {
    if (!receiver_id) return;
    
    axios.get('/messages/' + receiver_id).then(res=>{
        // Check if response data exists and is an array
        if (!res.data || !Array.isArray(res.data)) {
            return;
        }
        
        // Get current messages
        const currentMessages = document.querySelectorAll('.msg');
        const currentMessageIds = Array.from(currentMessages).map(msg => msg.dataset.messageId);
        
        // Find new messages that aren't in the current view
        const newMessages = res.data.filter(msg => 
            !currentMessageIds.includes(msg.id.toString())
        );
        
        // Display new messages
        newMessages.forEach(msg => {
            const messageHtml = renderMsg(msg);
            document.getElementById('messages').insertAdjacentHTML('beforeend', messageHtml);
        });
        
        // Update unread count for other users
        updatesCount = res.data.filter(msg => 
            msg.receiver_id != receiver_id && !msg.seen
        ).length;
        updateUpdatesBadge(updatesCount);
        
        // Scroll to bottom if new messages were added
        if (newMessages.length > 0) {
            scrollBottom();
            // Show notification for new messages
            showNewMessageNotification(newMessages.length);
        }
    }).catch(err=>{
        console.error('Error checking new messages:', err);
    });
};

// Show notification for new messages
function showNewMessageNotification(count) {
    const notification = document.createElement('div');
    notification.innerHTML = `
        <div style="position:fixed;top:20px;right:20px;background:#25D366;color:white;padding:10px 15px;border-radius:8px;z-index:1000;animation:slideIn 0.3s;">
            ${count} new message${count > 1 ? 's' : ''}
        </div>
    `;
    
    // Add animation CSS if not exists
    if (!document.querySelector('#notificationCSS')) {
        const style = document.createElement('style');
        style.id = 'notificationCSS';
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        `;
        document.head.appendChild(style);
    }
    
    document.body.appendChild(notification);
    
    // Auto-remove notification after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Update checkNewMessages to track unread messages
const originalCheckNewMessages = checkNewMessages;
checkNewMessages = function() {
    if (!receiver_id) return;
    
    axios.get('/messages/' + receiver_id).then(res => {
        // Check if response data exists and is an array
        if (!res.data || !Array.isArray(res.data)) {
            return;
        }
        
        const newMessages = res.data.filter(m => m && m.id > lastMessageId);
        
        if (newMessages.length > 0) {
            newMessages.forEach(msg => {
                // Only show messages from other users (received messages)
                if (msg.sender_id != {{ auth()->id() }}) {
                    document.getElementById('messages').innerHTML += renderMsg(msg);
                    document.getElementById('tone').play();
                    
                    // Increment unread count if chat is not active
                    if (!document.getElementById('chat').classList.contains('active')) {
                        unreadCount++;
                        updateChatBadge(unreadCount);
                    }
                }
            });
            
            // Update last message ID safely
            const validMessages = res.data.filter(m => m && m.id);
            if (validMessages.length > 0) {
                lastMessageId = Math.max(...validMessages.map(m => m.id));
            }
            
            scrollBottom();
        }
    }).catch(error => {
        // Silently handle errors to prevent console spam
        console.warn('Error checking messages:', error);
    });
};

// Profile Image Upload Function
function handleProfileImageUpload(event) {
    const file = event.target.files[0];
    if (!file) return;
    
    // Validate file type
    if (!file.type.startsWith('image/')) {
        showNotification('Please select a valid image file', 'error');
        return;
    }
    
    // Validate file size (2MB max)
    if (file.size > 2 * 1024 * 1024) {
        showNotification('Image size must be less than 2MB', 'error');
        return;
    }
    
    const formData = new FormData();
    formData.append('profile_image', file);
    
    // Show loading state
    const container = document.getElementById('profileImageContainer');
    const originalContent = container.innerHTML;
    container.innerHTML = '<div style="color:#25D366;font-size:20px;">⏳ Uploading...</div>';
    
    axios.post('/upload-profile-image', formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (response.data.success) {
            // Update profile image display
            updateProfileImageDisplay(response.data.image_url);
            showNotification(response.data.message, 'success');
            
            // Update user list avatar if exists
            updateUserAvatar(response.data.image_url);
        } else {
            showNotification(response.data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error uploading profile image:', error);
        showNotification('Error uploading profile image', 'error');
    })
    .finally(() => {
        // Restore container content with updated image
        loadProfileData();
    });
}

// Update profile image display
function updateProfileImageDisplay(imageUrl) {
    const profileImage = document.getElementById('profileImage');
    const profilePlaceholder = document.getElementById('profilePlaceholder');
    
    // Check if elements exist before trying to modify them
    if (!profileImage || !profilePlaceholder) {
        console.warn('Profile image elements not found in DOM');
        return;
    }
    
    if (imageUrl) {
        profileImage.src = imageUrl;
        profileImage.style.display = 'block';
        profilePlaceholder.style.display = 'none';
    }
}

// Update user avatar in sidebar
function updateUserAvatar(imageUrl) {
    const userAvatar = document.querySelector('.user-avatar');
    if (userAvatar && imageUrl) {
        userAvatar.style.backgroundImage = `url(${imageUrl})`;
        userAvatar.style.backgroundSize = 'cover';
        userAvatar.style.backgroundPosition = 'center';
        userAvatar.innerHTML = '';
    }
}

// Load profile data
function loadProfileData() {
    axios.get('/get-profile', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (response.data.success) {
            const user = response.data.user;
            
            // Update profile display only if elements exist
            const profileName = document.getElementById('profileName');
            const profileAbout = document.getElementById('profileAbout');
            const profilePhone = document.getElementById('profilePhone');
            
            if (profileName) profileName.textContent = user.name || 'Not set';
            if (profileAbout) profileAbout.textContent = user.bio || 'Hey there! I am using Support Chat.';
            if (profilePhone) profilePhone.textContent = user.phone || 'Not set';
            
            // Update profile image
            updateProfileImageDisplay(user.avatar);
            
            // Update user avatar in sidebar
            updateUserAvatar(user.avatar);
        }
    })
    .catch(error => {
        console.error('Error loading profile data:', error);
    });
}

// Edit profile info
function editProfileInfo(field) {
    let currentValue = '';
    let placeholder = '';
    let label = '';
    
    switch(field) {
        case 'name':
            currentValue = document.getElementById('profileName').textContent;
            placeholder = 'Enter your name';
            label = 'Name';
            break;
        case 'about':
            currentValue = document.getElementById('profileAbout').textContent;
            placeholder = 'Enter your bio';
            label = 'About';
            break;
        case 'phone':
            currentValue = document.getElementById('profilePhone').textContent;
            placeholder = 'Enter your phone number';
            label = 'Phone';
            break;
    }
    
    const newValue = prompt(`Edit ${label}:`, currentValue === 'Not set' ? '' : currentValue);
    
    if (newValue !== null && newValue.trim() !== '') {
        updateProfileField(field, newValue.trim());
    }
}

// Update profile field
function updateProfileField(field, value) {
    const formData = {};
    
    switch(field) {
        case 'name':
            formData.name = value;
            break;
        case 'about':
            formData.bio = value;
            break;
        case 'phone':
            formData.phone = value;
            break;
    }
    
    axios.post('/update-profile', formData, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (response.data.success) {
            // Update display only if elements exist
            switch(field) {
                case 'name':
                    const profileName = document.getElementById('profileName');
                    if (profileName) profileName.textContent = value;
                    break;
                case 'about':
                    const profileAbout = document.getElementById('profileAbout');
                    if (profileAbout) profileAbout.textContent = value;
                    break;
                case 'phone':
                    const profilePhone = document.getElementById('profilePhone');
                    if (profilePhone) profilePhone.textContent = value;
                    break;
            }
            
            showNotification('Profile updated successfully', 'success');
            
            // Update user name in sidebar if name was changed
            if (field === 'name') {
                const userNameElements = document.querySelectorAll('.user-name');
                userNameElements.forEach(element => {
                    if (element.textContent.includes('{{ auth()->user()->name }}') || 
                        element.textContent.trim() === '') {
                        element.textContent = value;
                    }
                });
            }
        } else {
            showNotification(response.data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error updating profile:', error);
        showNotification('Error updating profile', 'error');
    });
}

// Show notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    const bgColor = type === 'success' ? '#25D366' : type === 'error' ? '#dc3545' : '#17a2b8';
    
    notification.innerHTML = `
        <div style="position:fixed;top:20px;right:20px;background:${bgColor};color:white;padding:12px 20px;border-radius:8px;z-index:10000;animation:slideIn 0.3s;box-shadow:0 4px 12px rgba(0,0,0,0.15);">
            ${message}
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto-remove notification after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Add slideOut animation
if (!document.querySelector('#notificationAnimations')) {
    const style = document.createElement('style');
    style.id = 'notificationAnimations';
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
}

// Toggle between send and mic button based on message input
function toggleSendButton(messageText) {
    const sendButton = document.getElementById('sendButton');
    
    if (messageText.trim() === '') {
        // Show mic button when input is empty
        sendButton.innerHTML = '<i class="fas fa-microphone"></i>';
        sendButton.onclick = function() {
            document.getElementById('audio').click();
        };
        sendButton.classList.remove('send-btn');
    } else {
        // Show send button when input has text
        sendButton.innerHTML = '<i class="fas fa-paper-plane"></i>';
        sendButton.onclick = function() {
            send();
        };
        sendButton.classList.add('send-btn');
    }
}




// Recording functionality for mic button
let mediaRecorder;
let audioChunks = [];
let isRecording = false;

// Toggle between mic and send button based on message input
function toggleActionButton(messageText) {
    const actionButton = document.getElementById('micButton');
    
    if (messageText.trim() === '') {
        // Show mic button when input is empty
        actionButton.innerHTML = '<i class="fas fa-microphone"></i>';
        actionButton.classList.remove('send-btn');
        actionButton.style.background = '';
    } else {
        // Show send button when input has text
        actionButton.innerHTML = '<i class="fas fa-paper-plane"></i>';
        actionButton.classList.add('send-btn');
        actionButton.style.background = '';
    }
}

// Handle action button click (mic or send)
function handleActionButton() {
    const actionButton = document.getElementById('micButton');
    const msgInput = document.getElementById('msg');
    const message = msgInput.value.trim();
    
    if (message !== '') {
        // Send message
        msgInput.value = '';
        if (typeof sendMessage === 'function') {
            sendMessage();
        }
        // Reset button to mic
        toggleActionButton('');
    } else {
        // Handle recording
        if (!isRecording) {
            // Start recording
            navigator.mediaDevices.getUserMedia({ audio: true })
                .then(stream => {
                    mediaRecorder = new MediaRecorder(stream);
                    audioChunks = [];
                    
                    mediaRecorder.ondataavailable = event => {
                        audioChunks.push(event.data);
                    };
                    
                    mediaRecorder.onstop = () => {
                        const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                        const audioFile = new File([audioBlob], 'recording.wav', { type: 'audio/wav' });
                        
                        // Create event object to simulate file upload
                        const event = { target: { files: [audioFile] } };
                        handleAudioUpload(event);
                        
                        // Stop all tracks
                        stream.getTracks().forEach(track => track.stop());
                    };
                    
                    mediaRecorder.start();
                    isRecording = true;
                    actionButton.innerHTML = '<i class="fas fa-stop"></i>';
                    actionButton.style.background = '#dc3545';
                    actionButton.classList.remove('send-btn');
                    showNotification('Recording started', 'info');
                })
                .catch(err => {
                    console.error('Error accessing microphone:', err);
                    showNotification('Microphone access denied', 'error');
                    
                    // Fallback to file upload
                    const audioInput = document.createElement('input');
                    audioInput.type = 'file';
                    audioInput.accept = 'audio/*';
                    audioInput.style.display = 'none';
                    audioInput.onchange = function(event) {
                        handleAudioUpload(event);
                    };
                    document.body.appendChild(audioInput);
                    audioInput.click();
                    document.body.removeChild(audioInput);
                });
        } else {
            // Stop recording
            if (mediaRecorder && mediaRecorder.state !== 'inactive') {
                mediaRecorder.stop();
                isRecording = false;
                actionButton.innerHTML = '<i class="fas fa-microphone"></i>';
                actionButton.style.background = '';
                showNotification('Recording stopped', 'success');
            }
        }
    }
}

// Attachment popup functions
function showAttachmentPopup() {
    const popup = document.getElementById('attachmentPopup');
    popup.style.display = 'flex';
}

function hideAttachmentPopup() {
    const popup = document.getElementById('attachmentPopup');
    popup.style.display = 'none';
}

function selectAttachmentOption(option) {
    hideAttachmentPopup();
    
    switch(option) {
        case 'camera':
            // Open camera
            const cameraInput = document.createElement('input');
            cameraInput.type = 'file';
            cameraInput.accept = 'image/*';
            cameraInput.capture = 'camera';
            cameraInput.style.display = 'none';
            cameraInput.onchange = function(event) {
                handleImageUpload(event);
            };
            document.body.appendChild(cameraInput);
            cameraInput.click();
            document.body.removeChild(cameraInput);
            break;
            
        case 'gallery':
            // Open gallery
            document.getElementById('img').click();
            break;
            
        case 'location':
            // Get and share location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        const locationMessage = `📍 Location: https://maps.google.com/?q=${lat},${lng}`;
                        
                        // Send location as message
                        const msgInput = document.getElementById('msg');
                        msgInput.value = locationMessage;
                        if (typeof sendMessage === 'function') {
                            sendMessage();
                        }
                        showNotification('Location shared successfully', 'success');
                    },
                    function(error) {
                        console.error('Error getting location:', error);
                        showNotification('Unable to get location', 'error');
                    }
                );
            } else {
                showNotification('Geolocation is not supported by this browser', 'error');
            }
            break;
            
        case 'document':
            // Open document picker
            const docInput = document.createElement('input');
            docInput.type = 'file';
            docInput.accept = '.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar';
            docInput.style.display = 'none';
            docInput.onchange = function(event) {
                handleDocumentUpload(event);
            };
            document.body.appendChild(docInput);
            docInput.click();
            document.body.removeChild(docInput);
            break;
    }
}

// Handle document upload
function handleDocumentUpload(event) {
    const file = event.target.files[0];
    if (file) {
        // Here you can implement document upload logic
        // For now, just show a notification
        showNotification(`Document "${file.name}" selected`, 'info');
        
        // You can add actual upload logic here similar to image upload
        const formData = new FormData();
        formData.append('document', file);
        
        // Add your document upload API call here
        console.log('Document upload:', file);
    }
}

// Initialize profile data when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadProfileData();
    // Initialize button state to mic
    toggleActionButton('');
});
</script>

</body>
</html>