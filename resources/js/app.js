// resources/js/app.js
import './bootstrap';
import { initializeLoading } from './loading';

// Wrap in try-catch to help debug any issues
try {
    initializeLoading();
    console.log('App.js loaded successfully');
} catch (error) {
    console.error('Error initializing loading functionality:', error);
}