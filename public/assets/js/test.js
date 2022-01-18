function IsValid() {
    let s = "hhh";
    const pattern = ['(',')','[',']','{','}'];
    if(s.length < 1 || s.length > 140) return false;
    if(s.length % 2 != 0) return false;
    for(let i = 0; i < pattern.length; i += 2) {
        if(s.charAt(0) == pattern[i]) return false;
    }

    for(let i = 0; i < s.length; i++) {
        let exists = false;
        for(let j = 0; j < pattern.length; j++) {
            if(s.charAt(i) == pattern[j]) {
                exists = true;
                break;
            }
        }
        if(!exists) return false;
    }

    for(let i = 0; i < s.length - 1; i++) {
        if(s.charAt(i) == pattern[0]) {
            if(s.charAt(i+1) == pattern[3] || s.charAt(i+1) == pattern[5]) return false;
        }
        if(s.charAt(i) == pattern[2]) {
            if(s.charAt(i+1) == pattern[1] || s.charAt(i+1) == pattern[5]) return false;
        }
        if(s.charAt(i) == pattern[4]) {
            if(s.charAt(i+1) == pattern[1] || s.charAt(i+1) == pattern[3]) return false;
        }
    }
    return true;
}