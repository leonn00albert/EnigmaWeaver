import { useState } from "react"
import { InputGroup, Form, Button } from "react-bootstrap"


export function TextEncode({ setTextResult }) {
    const [inputText, setInputText] = useState("");
    const handleChange = (e) => {
        setInputText(e.target.value);
    }
    const handleClick = () => {
        fetch("/api/morse/text-to-morse", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body:
                JSON.stringify({
                    text: inputText
                })

        })
            .then(res => res.json())
            .then(res => {
                setTextResult(res.code);
            })
            .catch(e => console.log(e));
    }
    return (
        <>
            <InputGroup className="m-5">
                <InputGroup.Text id="basic-addon1">Encode morse code</InputGroup.Text>
                <Form.Control
                    onChange={handleChange}
                    placeholder="type something"
                    aria-label="text"
                    aria-describedby="basic-addon1"
                    value={inputText}
                />
                <Button onClick={handleClick} variant="outline-secondary" id="button-addon2">
                    Encode
                </Button>
            </InputGroup>

        </>
    )


}   