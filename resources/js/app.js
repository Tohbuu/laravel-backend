
import './bootstrap';

// Socket.io client integration
const socket = io('http://localhost:3001');

socket.on('portfolioRefresh', (userId) => {
    if (userId === document.body.dataset.userId) {
        window.location.reload();
    }
});