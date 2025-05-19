const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const cors = require('cors');

const app = express();
app.use(cors());

const server = http.createServer(app);
const io = socketIo(server, {
    cors: {
        origin: "http://localhost:8000", // Your Laravel app URL
        methods: ["GET", "POST"]
    }
});

// Track active users
const activeUsers = new Set();

io.on('connection', (socket) => {
    console.log('New client connected');
    
    socket.on('userOnline', (userId) => {
        activeUsers.add(userId);
        io.emit('activeUsers', Array.from(activeUsers));
    });
    
    socket.on('disconnect', () => {
        console.log('Client disconnected');
        // Note: In a real app, you'd need a way to map sockets to users
    });
    
    // Portfolio update notifications
    socket.on('portfolioUpdated', (userId) => {
        io.emit('portfolioRefresh', userId);
    });
});

const PORT = process.env.PORT || 3001;
server.listen(PORT, () => console.log(`Node server running on port ${PORT}`));