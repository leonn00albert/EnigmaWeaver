import { Container,Card } from "react-bootstrap"
import { TextEncode } from "./textEncode"
import { CodeBookTable } from "./table"
import { useState } from "react";
import { TextDecode } from "./textDecode";


export function Index() {
    const [results, setResults] = useState([]);
    const [textResult, setTextResult] = useState("");
    const loadText = () => {
        if(textResult) {
            return (
                <Card body>{textResult}</Card>
            );
        }
    }

    return (
        <Container>
            <h1 className="header">Welcome To EnigmaWeave</h1>

            We now support Morse code

            <span role="img" aria-label="tada">
                🎉
            </span>
            <TextEncode setTextResult={setTextResult}/>
            <TextDecode setTextResult={setTextResult}/>
            {loadText()}
            <CodeBookTable items={results} setResults={setResults} />
        </Container>


    );
}