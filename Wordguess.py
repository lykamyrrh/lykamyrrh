import random
import time
import tkinter as tk

words = ["python", "java", "debug", "software", "agile", "encryption", "cpu", "application", "byte", "compiler"]

class WordGuessGame:
    def __init__(self, root):
        self.submit_button = None
        self.guess_entry = None
        self.word_label = None
        self.root = root
        self.root.title("Word Guessing Game")
        self.guessed_word_index = 0
        self.correct_guesses = 0
        self.word_to_guess = tk.StringVar(value="")
        self.correct_word = ""
        self.response_label = tk.Label(self.root, bg='#d1c5e1', text="", font=("Arial", 14))
        self.timer_label = tk.Label(self.root, bg='#d1c5e1', text="", font=("Arial", 12))
        self.word_count_label = tk.Label(self.root, bg='#d1c5e1', text="", font=("Arial", 14))
        self.word_to_guess.set('?')
        self.start_time = 0
        self.timer = 20
        self.setup_gui()

    def setup_gui(self):
        tk.Label(self.root, text="Welcome to Word Guessing Game", bg='#d1c5e1', font=("Arial", 16,)).pack(pady=20)
        self.timer_label.pack()
        self.word_label = tk.Label(self.root, textvariable=self.word_to_guess, font=("Arial", 14,), bg="#d1c5e1")
        self.word_label.pack()
        self.guess_entry = tk.Entry(self.root, bg='pink', font=("Arial", 14))
        self.guess_entry.pack(pady=10)
        self.submit_button = tk.Button(self.root, bg='pink', text="Guess", command=self.check_guess, font=("Arial", 14))
        self.submit_button.pack()
        self.response_label.pack()
        self.word_count_label.pack()

    def start_game(self):
        self.guessed_word_index = 0
        self.correct_guesses = 0
        self.word_to_guess.set('')
        self.update_word_count()
        self.start_time = time.time()
        self.update_timer()
        self.response_label.config(text="")
        self.next_word()

    def next_word(self):
        if self.guessed_word_index < len(words):
            self.correct_word = words[self.guessed_word_index]
            self.guess_entry.delete(0, 'end')
            self.guess_entry.focus()
            self.timer = 20  # Reset the timer here
        else:
            self.word_to_guess.set("You've guessed all the words! Game over.")
            self.word_to_guess.config(bg='#d1c5e1')
            self.timer_label.config(bg='#d1c5e1', text="")
            self.stop_timer()  # Stop the timer when all words are guessed correctly

    def check_guess(self):
        if self.guessed_word_index >= len(words):
            return  # Do not continue further guesses if the game is over

        guess = self.guess_entry.get().lower()
        if guess == self.correct_word:
            self.guessed_word_index += 1
            self.correct_guesses += 1
            self.response_label.config(text="Correct!")
            self.update_word_count()
            self.start_time = time.time()
            self.timer_label.config(bg='#d1c5e1', text="")
            if self.guessed_word_index < len(words):
                self.next_word()  # Move to the next word and reset the timer
            else:
                self.word_to_guess.set("You've guessed all the words! Game over.")
                self.word_to_guess.config(bg='#d1c5e1')
                self.timer_label.config(bg='#d1c5e1', text="")
                self.stop_timer()  # Stop the timer when all words are guessed correctly

        else:
            self.guess_entry.delete(0, 'end')
            self.response_label.config(bg='#d1c5e1', text="Wrong. Try again.")

    def update_timer(self):
        elapsed_time = int(time.time() - self.start_time)
        remaining_time = max(0, self.timer - elapsed_time)
        self.timer_label.config(bg='#d1c5e1', text=f"Time remaining: {remaining_time} seconds")
        if remaining_time > 0 and self.guessed_word_index < len(words):
            self.root.after(1000, self.update_timer)
        else:
            self.response_label.config(bg='#d1c5e1', text="Time is up!")

    def stop_timer(self):
        self.timer_label.config(text="")

    def update_word_count(self):
        self.word_count_label.config(bg='#d1c5e1', text=f"Correct Guesses: {self.correct_guesses}/{len(words)}")

def main():
    root = tk.Tk()
    game = WordGuessGame(root)
    start_button = tk.Button(root, bg='pink', text="Start Game", command=game.start_game, font=("Arial", 14))
    root.configure(bg='#d1c5e1')
    start_button.pack()
    root.mainloop()

if __name__ == "__main__":
    main()
