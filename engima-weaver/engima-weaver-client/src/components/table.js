import { Button, Table } from "react-bootstrap"

export function CodeBookTable({ items, setResults }) {
    const handleClick = () => {
        fetch("/api/morse/get-code-book")
            .then(res => res.json())
            .then(res => {
                console.log(res.code_book)
                setResults(res.code_book)
            })
            .catch(e => console.log(e))
    }
    return (
        <>
            <Button onClick={handleClick} variant="outline-secondary" id="button-addon2">
                Get Code Book
            </Button>
            <Table>
                <thead>
                    <tr>
                        <th>Letter</th>
                        <th>Morse Code</th>
                    </tr>
                </thead>
                <tbody>
                    {Object.keys(items).map(key => {
                        return (
                            <tr key={key}>
                                <td>{key}</td>
                                <td>{items[key]}</td>
                            </tr>
                        )
                    })}
                </tbody>
            </Table>
        </>

    )

}