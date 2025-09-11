import './bootstrap';

const API = import.meta.env.VITE_API_URL || 'http://localhost:8000';
await fetch(`${API}/api/products`)
    .then(r => r.json())
    .then(data => console.log(data));
