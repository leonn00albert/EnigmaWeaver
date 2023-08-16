import { useState } from "react"
import { InputGroup, Form, Button } from "react-bootstrap"


export function TextDecode({ setTextResult }) {
    const [inputText, setInputText] = useState("");
    const handleChange = (e) => {
        setInputText(e.target.value);
    }
    const handleClick = () => {
        fetch("/api/morse/morse-to-text", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body:
                JSON.stringify({
                    code: inputText
                })

        })
            .then(res => res.json())
            .then(res => {
                setTextResult(res.text);
            })
            .catch(e => console.log(e));
    }
    return (
        <>
            <InputGroup className="m-5">
                <InputGroup.Text id="basic-addon1">Decode morse code</InputGroup.Text>
                <Form.Control
                    onChange={handleChange}
                    placeholder="type something"
                    aria-label="text"
                    aria-describedby="basic-addon1"
                    value={inputText}
                />
                <Button onClick={handleClick} variant="outline-secondary" id="button-addon2">
                    Decode
                </Button>
            </InputGroup>

        </>
    )


}   