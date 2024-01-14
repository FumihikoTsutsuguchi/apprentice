// クラスを自作し、使うことができる
class Playlist {
    constructor(name) {
        this.name = name;
        this.songs = [];
    }
    addSong(song) {
        this.songs.push(song);
    }
    removeSong(song) {
        // this.songs = this.songs.filter(function (value) {
        //     return value !== song;
        // });
        const index = this.songs.indexOf(song);
        console.log(index);
        if (index !== -1) {
            this.songs.splice(index, 1);
        }
    }
    play() {
        console.log(`再生中:${this.songs[0]}`);
    }
}
let myPlaylist = new Playlist("お気に入りリスト");
// myPlaylist.addSong("aaa");
// myPlaylist.addSong("bbb");
// myPlaylist.addSong("花束");
// myPlaylist.addSong("Lemon");
// myPlaylist.addSong("こんにちは赤ちゃん");
// myPlaylist.removeSong("bbb");
// console.log(myPlaylist.songs);
// myPlaylist.play();

// 例外処理を使うことができる
const checkDivisibleByFive = (num) => {
    if (num % 5 === 0) {
        return true;
    } else {
        throw new Error("数値は5で割り切れません");
    }
}

// 処理を記述、try...catch 構文を使用し、その中で checkDivisibleByFive 関数を呼び出す
try {
    let num = 15;
    const result = checkDivisibleByFive(num);
    console.log(`${num}は5で割り切れます:${result}`);
} catch (error) {
    console.error(error.message);
}
