const express = require('express');
const bodyParser = require('body-parser');
const session = require('express-session');
const cors = require('cors');

const app = express();
const PORT = 3000;

// Middleware
app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(
  session({
    secret: 'secret-key', // Měj lepší tajný klíč!
    resave: false,
    saveUninitialized: true,
  })
);

// Inicializace session pro uživatele
app.use((req, res, next) => {
  if (!req.session.users) {
    req.session.users = {};
  }
  next();
});

// Helper pro odeslání JSON odpovědi
const sendJSONResponse = (res, data, status = 200) => {
  res.status(status).json(data);
};

// GET všech uživatelů nebo konkrétního uživatele
app.get('/api/get/:id?', (req, res) => {
  const { id } = req.params;
  if (id) {
    const user = req.session.users[id];
    if (user) {
      sendJSONResponse(res, user);
    } else {
      sendJSONResponse(res, { error: 'User not found' }, 404);
    }
  } else {
    sendJSONResponse(res, Object.values(req.session.users));
  }
});

// POST nový uživatel
app.post('/api/post', (req, res) => {
  const { id, name, surname } = req.body;

  if (!id || !name || !surname) {
    sendJSONResponse(res, { error: 'Invalid data provided' }, 400);
    return;
  }

  req.session.users[id] = { id, name, surname };
  sendJSONResponse(res, { success: 'User added' }, 201);
});

// PUT aktualizace uživatele
app.put('/api/update/:id', (req, res) => {
  const { id } = req.params;
  const { name, surname } = req.body;

  if (!req.session.users[id]) {
    sendJSONResponse(res, { error: 'User not found' }, 404);
    return;
  }

  req.session.users[id] = { ...req.session.users[id], name, surname };
  sendJSONResponse(res, { success: 'User updated' });
});

// DELETE uživatel
app.delete('/api/delete/:id', (req, res) => {
  const { id } = req.params;

  if (!req.session.users[id]) {
    sendJSONResponse(res, { error: 'User not found' }, 404);
    return;
  }

  delete req.session.users[id];
  sendJSONResponse(res, { success: 'User deleted' });
});

// Start server
app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
